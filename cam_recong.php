<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Input and Content Generation</title>
</head>
<body>

<h2>Take a Picture to Find the Book Title</h2>

<!-- Form to capture image from camera -->
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="image" accept="image/*" capture="environment" required>
    <br><br>
    <input type="submit" value="Upload and Generate Title">
</form>

<?php
// Function to upload files and generate content
function uploadFileAndGenerateContent($apiKey, $filePath) {
    $mimeType = mime_content_type($filePath); // Detect the MIME type dynamically

    // Check if file exists
    if (!file_exists($filePath)) {
        throw new Exception("File not found: " . $filePath);
    }
    $numBytes = filesize($filePath);

    // Upload the file
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://generativelanguage.googleapis.com/upload/v1beta/files?key=$apiKey");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "X-Goog-Upload-Command: start, upload, finalize",
        "X-Goog-Upload-Header-Content-Length: $numBytes",
        "X-Goog-Upload-Header-Content-Type: $mimeType",
        "Content-Type: $mimeType"  // Set the correct content type for the image
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, file_get_contents($filePath)); // Send the file as binary
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    // Disable SSL verification
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($curl);
    
    if ($response === false) {
        throw new Exception('Error during file upload: ' . curl_error($curl));
    }

    $responseData = json_decode($response, true); // Decode the response as associative array
    $fileUri = $responseData['file']['uri'] ?? null; // Adjust based on the actual response structure

    curl_close($curl);

    if (!$fileUri) {
        throw new Exception('Failed to retrieve file URI from the response.');
    }

    // Generate content
    $generationConfig = [
        'temperature' => 1,
        'topK' => 64,
        'topP' => 0.95,
        'maxOutputTokens' => 8192,
        'responseMimeType' => 'text/plain'
    ];
    
    $requestBody = [
        'contents' => [
            [
                'role' => 'user',
                'parts' => [
                    [
                        'fileData' => [
                            'fileUri' => $fileUri,
                            'mimeType' => $mimeType
                        ]
                    ],
                    [
                        'text' => "Find the title of the book"
                    ]
                ]
            ]
        ],
        'generationConfig' => $generationConfig
    ];
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$apiKey");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestBody));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    // Disable SSL verification for this request as well
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($curl);
    if ($response === false) {
        throw new Exception('Error during content generation: ' . curl_error($curl));
    }

    $result = json_decode($response); // Decode the response
    return $result;
}

// Handle file upload and content generation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $apiKey = ""; // Replace with your actual API key
    $filePath = $_FILES['image']['tmp_name'];

    try {
        $result = uploadFileAndGenerateContent($apiKey, $filePath);
        $title = ""; // Initialize title variable

        // Check if 'candidates' field exists in response
        if (isset($result->candidates) && !empty($result->candidates)) {
            $firstCandidate = $result->candidates[0]; // Extract the first candidate
            if (isset($firstCandidate->content->parts[0]->text)) {
                $title = $firstCandidate->content->parts[0]->text; // Extract the book title
            }
        } else {
            echo "<pre>No 'candidates' found in the response.</pre>";
        }
        
        echo "<h2>Book Title: $title</h2>"; // Display only the title
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

</body>
</html>

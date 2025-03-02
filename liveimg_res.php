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
        "Content-Type: $mimeType"  
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, file_get_contents($filePath)); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($curl);
    
    if ($response === false) {
        throw new Exception('Error during file upload: ' . curl_error($curl));
    }

    $responseData = json_decode($response, true);
    $fileUri = $responseData['file']['uri'] ?? null;

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
                        'text' => "Find the title of the book and only output the title"
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
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($curl);
    if ($response === false) {
        throw new Exception('Error during content generation: ' . curl_error($curl));
    }

    $result = json_decode($response);
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
        
        echo " $title"; // Display only the title
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

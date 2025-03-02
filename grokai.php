<?php
// Function to send chat request
function sendChatRequest($userInput) {
    $url = "https://api.x.ai/v1/chat/completions";
    $apiKey = "xai-COSCGz9jShLi2dcRJ0WbK3A7Iz3SmVPPIm2nuz94a6o16RwT8R2uSbTNYLOyn8cZBxc1X2mb8MefpQMs";

    // Prepare the data to be sent in the request
    $data = [
        'messages' => [
            ['role' => 'system', 'content' => 'You are a test assistant.'],
            ['role' => 'user', 'content' => $userInput],
        ],
        'model' => 'grok-beta',
        'stream' => false,
        'temperature' => 0
    ];

    // Encode the data to JSON
    $jsonData = json_encode($data);

    // Initialize cURL
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Use POST method
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Attach the JSON data
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    // Disable SSL verification (for local development only)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    // Execute cURL and capture the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    } else {
        // Decode the response from JSON
        $result = json_decode($response, true);
        
        // Extract the assistant's reply
        if (isset($result['choices'][0]['message']['content'])) {
            echo "Assistant's Response: " . $result['choices'][0]['message']['content'];
        } else {
            echo "Error: Unable to extract response.";
        }
    }

    // Close cURL session
    curl_close($ch);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = $_POST['userInput']; // Get the user input
    sendChatRequest($userInput); // Call the function with user input
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Assistant</title>
</head>
<body>
    <h2>Chat with Assistant</h2>
    <form method="post" action="">
        <label for="userInput">Enter your message:</label><br>
        <textarea id="userInput" name="userInput" rows="4" cols="50" placeholder="Type your message here..."></textarea><br><br>
        <input type="submit" value="Send Message">
    </form>
</body>
</html>

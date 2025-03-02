<?php
// Initialize cURL session
$ch = curl_init();

// Set the URL
$url = "https://api.example.com/getEndpoint";
curl_setopt($ch, CURLOPT_URL, $url);

// Set the option to return the response instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Display the response
    echo $response;
}

// Close the cURL session
curl_close($ch);
?>

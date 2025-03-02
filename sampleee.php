<?php

// Your API key
$apiKey = '';

// API endpoint
$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey;

// Data to be sent in the request
$data = [
    'contents' => [
        [
            'role' => 'user',
            'parts' => [
                [
                    'text' => 'INSERT_INPUT_HERE'
                ]
            ]
        ]
    ],
    'generationConfig' => [
        'temperature' => 1,
        'topK' => 64,
        'topP' => 0.95,
        'maxOutputTokens' => 8192,
        'responseMimeType' => 'text/plain'
    ]
];

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Print the response
    echo $response;
}

// Close cURL
curl_close($ch);

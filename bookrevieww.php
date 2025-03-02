<?php

function generateBookReview($bookTitle) {
    // Define the API URL and key
    $apiKey = 'AIzaSyCBoO8cdangwvhzIJI3l68xt5U2cVC0gnU'; // Replace with your API key
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta2/models/gemini-1.5-turbo:generateText?key=" . $apiKey;

    // The starting prompt
    $prompt = "Assume you are a book reviewer. Your task is to write a review for children. Write a review of the following book: " . $bookTitle;

    // Prepare the request payload
    $data = array(
        "prompt" => array(
            "text" => $prompt
        )
    );

    // Initialize curl
    $ch = curl_init($apiUrl);

    // Set curl options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute curl and get the response
    $response = curl_exec($ch);

    // Close curl
    curl_close($ch);

    // Decode the JSON response
    $result = json_decode($response, true);

    // Extract the review text from the response
    if (isset($result['candidates'][0]['output'])) {
        return $result['candidates'][0]['output'];
    } else {
        return "Error generating review: " . $response;
    }    
}

// Usage example
$bookTitle = "The Adventures of Tom Sawyers";  // You can change this title
echo generateBookReview($bookTitle);

?>

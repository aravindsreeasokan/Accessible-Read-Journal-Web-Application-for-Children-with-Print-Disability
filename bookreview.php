<?php

function generateBookReview($bookTitle) {
    // Define the API URL and key
    $apiKey = 'APi'; // Replace with your API key
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $apiKey;

    // The starting prompt
    $prompt = "Assume you are a book reviewer. Your task is to write reviews for children. Write review of the following book: " . $bookTitle;

    // Prepare the request payload
    $data = array(
        "contents" => array(
            array(
                "parts" => array(
                    array(
                        "text" => $prompt
                    )
                )
            )
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

       // Decode the JSON response
    $result = json_decode($response, true);

    // Extract the review text from the nested structure
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        return $result['candidates'][0]['content']['parts'][0]['text'];
    } else {
        return "Error generating review: " . $response;
    }    


    
}

// Usage example
$bookTitle = "The Adventures of Tom Sawyer";  // You can change this title
echo generateBookReview($bookTitle);

?>

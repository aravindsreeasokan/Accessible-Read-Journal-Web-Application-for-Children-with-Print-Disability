<?php

function generateBookReview($bookTitle,$authorname) {
    $apiKey = 'AIzaSyCBoO8cdangwvhzIJI3l68xt5U2cVC0gnU'; // Replace with your API key
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $apiKey;

    $prompt = "Assume you are a  professional book reader. Your task is to write summary for book with important point. Write professional summary of the following book: " . $bookTitle."written by". $authorname;

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

    $ch = curl_init($apiUrl);

    // Set curl options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    // Disable SSL verification (for local development only)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }

    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        return $result['candidates'][0]['content']['parts'][0]['text'];
    } else {
        return "Error generating review: " . print_r($result, true);
    }
}

$bookTitle = $_POST['bookname'];
$authorname=$_POST['authorname']; 
echo generateBookReview($bookTitle,$authorname);

?>

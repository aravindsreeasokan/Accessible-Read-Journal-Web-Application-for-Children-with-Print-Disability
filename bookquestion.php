<?php

function generateBookQuestion($bookTitle,$authorname) {
    $apiKey = 'AIzaSyCBoO8cdangwvhzIJI3l68xt5U2cVC0gnU'; // Replace with your API key
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $apiKey;
    $prompt = "You are tasked with generating a unique and valid quiz question based on the book titled '" . $bookTitle . "' written by '" . $authorname . "'. Please create a different, fact-based question about the book, followed by four distinct answer options, with only one being correct. Ensure the correct option is accurate, and avoid repeating questions or answers.

Format the output as:

**Question:** What is [Insert fact-based question here]?

**A)** [Option A]  
**B)** [Option B]  
**C)** [Option C]  
**D)** [Option D]  

**Correct Answer:** [Correct option: A, B, C, or D]

Ensure that the question and options are based on valid information from the book, and the correct answer is clearly indicated.";

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
echo generateBookQuestion($bookTitle,$authorname);

?>

<?php

function generateBookReview($disabilityType) {
    $apiKey = 'U'; // Replace with your API key
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $apiKey;

    // Dynamically updated prompt based on the disability type
    $prompt = "Give 3 brief tips to assist children with " . $disabilityType . " disabilities in creating an ideal reading environment. Keep the tips concise and clear. Use simple language and avoid long sentences.";

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
        curl_close($ch);
        return; // No output if there's an error
    }

    curl_close($ch);

    $result = json_decode($response, true);

    // Check for valid response and output only the short tips
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        $tips = $result['candidates'][0]['content']['parts'][0]['text'];

        // Remove any unwanted characters like stars (*)
        $tips = str_replace('*', '', $tips);

        // Split tips by period (.) and display each tip simply
        $tipsArray = explode('.', $tips);
        foreach ($tipsArray as $tip) {
            if (trim($tip)) {
                echo trim($tip) . "\n"; // Display each tip on a new line without HTML tags
            }
        }
    }
}

if (isset($_POST['disability'])) {
    $disability = $_POST['disability'];// This can be changed to 'motor', 'learning', etc.
    generateBookReview($disability);
}
else
{
    echo "Error occured while fetching disability";
}

?>

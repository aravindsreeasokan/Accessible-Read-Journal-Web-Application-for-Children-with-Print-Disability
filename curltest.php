<?php

// Define the URL to fetch the webpage content.
$url = "https://www.geeksforgeeks.org/";

// Path to the certificate bundle.
$certPath = "C:/wamp/cacert.pem"; // Note the use of forward slashes or double backslashes

// Initialize a cURL session.
$ch = curl_init(); 

// Set cURL options:
    // Return the page contents as a string rather than outputting it directly.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Set the URL to fetch.
    curl_setopt($ch, CURLOPT_URL, $url);

    // Set the path to the certificate bundle.
    curl_setopt($ch, CURLOPT_CAINFO, $certPath);

// Execute the cURL session and fetch the content.
$result = curl_exec($ch);

// Check for errors.
if ($result === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    // Output the fetched content.
    echo $result;
}

// Close the cURL session.
curl_close($ch);

?>

<?php
$server_url = "http://localhost:8080/Project/mini%20-%20Copy/server.php";

// 1. Test GET Request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $server_url . "?name=John");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'GET Error: ' . curl_error($ch);
} else {
    echo "GET Response: $get_response <br>";
}
curl_close($ch);

// 2. Test POST Request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $server_url);
curl_setopt($ch, CURLOPT_POST, true);
$post_data = ['name' => 'Jane'];
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$post_response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'POST Error: ' . curl_error($ch);
} else {
    echo "POST Response: $post_response";
}
curl_close($ch);
?>

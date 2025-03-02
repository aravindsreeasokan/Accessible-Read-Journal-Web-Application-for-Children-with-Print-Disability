<?php
// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? 'Guest';
    echo "Hello, $name! This is a POST request response.";
} else {
    // For GET request
    $name = $_GET['name'] ?? 'Guest';
    echo "Hello, $name! This is a GET request response.";
}
?>

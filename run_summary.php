<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];

    // Combine book name and author name into a single string
    $inputText = "$bookname written by $authorname";
    echo $inputText;
    // Path to Node.js and script
    $nodePath = "C:\\Program Files\\nodejs\\node.exe";  // Adjust the path to your Node.js installation
    $scriptPath = "C:\\wamp64\\www\\Project\\mini - Copy\\summary.mjs";  // Path to your Node.js script
    
    // Escape input to make it shell-safe
    $escapedInputText = escapeshellarg($inputText);

    // Command to execute the Node.js script
    $command = "\"$nodePath\" \"$scriptPath\" $escapedInputText 2>&1";
    $output = shell_exec($command);

    // Return the result as a response
    if ($output !== null) {
        echo trim($output);
    } else {
        echo "Error: Could not generate summary.";
    }
}
?>

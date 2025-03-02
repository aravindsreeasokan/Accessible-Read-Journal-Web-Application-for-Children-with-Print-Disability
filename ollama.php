<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Correction with Ollama and Node.js</title>
</head>
<body>

<?php
$correctedText = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input text from the form
    $inputText = escapeshellarg($_POST["inputText"]);

    // Full path to the Node.js executable
    $nodePath = "C:\\Program Files\\nodejs\\node.exe"; // Adjust this path if Node.js is located elsewhere
    $scriptPath = "C:\\wamp64\\www\\Project\\rephrase.mjs"; // Full path to your Node.js script
    
    // Command to run the Node.js script with the input text
    $command = "\"$nodePath\" \"$scriptPath\" $inputText  ";

    // Execute the command and capture the output
    $output = shell_exec($command);

    // Check if output is not empty
    if ($output !== null) {
        // Assign the output to correctedText
        $correctedText = trim($output);
    } else {
        echo "<p><strong>Error:</strong> There was an issue running the command.</p>";
    }

    // Output the raw output for debugging purposes
    echo "<p><strong>Output:</strong><br>" . htmlspecialchars($correctedText) . "</p>";
}
?>

<!-- Form to enter text -->
<form method="post" action="">
    <label for="inputText">Enter text to correct:</label><br>
    <textarea id="inputText" name="inputText" rows="4" cols="50"><?php echo htmlspecialchars($correctedText); ?></textarea><br>
    <input type="submit" value="Correct Text">
</form>

</body>
</html>

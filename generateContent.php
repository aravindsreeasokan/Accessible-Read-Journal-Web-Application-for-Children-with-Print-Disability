<?php

// Replace with the path to your Node.js script
$nodeScript = 'generateContent.js';

// Input text
$inputText = 'INSERT_INPUT_HERE';

// Execute Node.js script
$command = "node $nodeScript " . escapeshellarg($inputText);
$output = shell_exec($command);

// Print the output
echo $output;

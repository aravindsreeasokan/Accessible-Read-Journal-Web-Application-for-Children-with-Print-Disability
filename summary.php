<?php
        $serial_no=$_POST['serialno'];
        $bookname=$_POST['bookname'];
        echo "please wait for the summary of $bookname";
        // Full path to the Node.js executable and script
        $nodePath = "C:\\Program Files\\nodejs\\node.exe"; // Adjust this path if necessary
        $scriptPath = "C:\\wamp64\\www\\Project\\mini - Copy\\summary.mjs"; // Adjust this path if necessary

        // Escape input for shell command
        $book = escapeshellarg($bookname);

        // Command to run the Node.js script
        $command = "\"$nodePath\" \"$scriptPath\" $book ";
        $output = shell_exec($command);

        // Capture the corrected review
        if ($output !== null) {
            $correctedReview = trim($output);
        } else {
            echo "<p><strong>Error:</strong> There was an issue running the command.</p>";
        }
?>

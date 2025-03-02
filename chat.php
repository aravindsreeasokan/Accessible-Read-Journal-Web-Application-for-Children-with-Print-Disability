<?php
session_start();
include("connection.php");

$mentorname = $_SESSION['username'];
$book_name = trim($_GET['bookname'] ?? '');
$readers_name = $_GET['readers_name'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert'])) {
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $sender = $_SESSION['username'];
    $book_name = $_POST['bookname'];
    $readers_name = $_POST['readers_name'];

    $query = "INSERT INTO chat_messages (receivers_name, book_name, message, sender) VALUES ('$readers_name', '$book_name', '$message', '$sender')";
    mysqli_query($con, $query);

    header("Location: " . $_SERVER['PHP_SELF'] . "?bookname=" . urlencode($book_name) . "&readers_name=" . urlencode($readers_name));
    exit();
}

$query = "SELECT * FROM chat_messages 
          WHERE ((sender='$mentorname' AND receivers_name='$readers_name') 
              OR (sender='$readers_name' AND receivers_name='$mentorname')) 
              AND book_name='$book_name'
          ORDER BY timestamp";
$result = mysqli_query($con, $query);

// Fetch book update details
$bookupdate = "SELECT * FROM read_tab WHERE book_name='$book_name' AND readers_name='$readers_name' AND mentor_name='$mentorname'";
$bookupdateresult = mysqli_query($con, $bookupdate);
$upd = mysqli_fetch_array($bookupdateresult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="yourchatstylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Chat</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <div class="chat-container">
        <h2>Chat with <?php echo htmlspecialchars($readers_name); ?></h2>
        <h6>Book Name: <?php echo htmlspecialchars($book_name); ?></h6>
        <h6>No.of Pages Completed: <?php echo htmlspecialchars($upd['pages_read'] ?? 'Not available'); ?></h6>
        <div class="chat-box" id="chat-box">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $messageClass = $row['sender'] == $mentorname ? 'sent' : 'received';
                    echo '<div class="chat-message ' . $messageClass . '">';
                    echo '<span class="chat-sender">' . htmlspecialchars($row['sender']) . ':</span> ';
                    echo '<span class="chat-text">' . htmlspecialchars($row['message']) . '</span>';
                    echo '<span class="chat-timestamp">' . htmlspecialchars($row['timestamp']) . '</span>';
                    echo '</div>';
                }
            } else {
                echo '<p>No messages yet.</p>';
            }
            ?>
        </div>
        <div class="chat-input">
            <form method="POST" action="">
                <input type="hidden" name="bookname" value="<?php echo htmlspecialchars($book_name); ?>">
                <input type="hidden" name="readers_name" value="<?php echo htmlspecialchars($readers_name); ?>">
                <textarea class="textarea" name="message" placeholder="Type your message here..." required></textarea>
                <button name="insert" type="submit"><i class='bx bx-paper-plane'></i></button>
            </form>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
</body>
</html>

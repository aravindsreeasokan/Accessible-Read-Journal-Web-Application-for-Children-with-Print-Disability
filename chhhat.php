<?php
session_start();
include("connection.php");

$studentname = $_SESSION['username'];
$mentornameQuery = "SELECT mentor_name FROM `mentor_student_tab` WHERE student_name='$studentname'";
$mentorresult = mysqli_query($con, $mentornameQuery);
$mentorname = '';
if ($mentorresult && mysqli_num_rows($mentorresult) > 0) {
    $row = mysqli_fetch_array($mentorresult);
    $mentorname = $row['mentor_name'];
}

// Handle message insertion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert'])) {
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $sender = $_SESSION['username'];
    $book_name = $_POST['bookname'];

    $insertquery = "INSERT INTO chat_messages (receivers_name, book_name, message, sender) VALUES ('$mentorname', '$book_name', '$message', '$sender')";
    mysqli_query($con, $insertquery);

    // Return the message response in JSON format
    echo json_encode(['message' => $message, 'sender' => $sender]);
    exit();
}
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
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        /* Navbar styling */
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 0px;
            text-align: center;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 15px;
            border-right: 1px solid #dee2e6;
            overflow-y: auto;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .sidebar li:hover {
            background-color: #e2e6ea;
        }

        .chat-area {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }

        #chat-window {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #messages {
            flex-grow: 1;
            overflow-y: auto;
            margin-bottom: 10px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sent, .received {
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            position: relative;
            margin: 5px 0;
        }

        .sent {
            background-color: #dcf8c6;
            align-self: flex-end;
        }

        .received {
            background-color: #ffffff;
            align-self: flex-start;
            border: 1px solid #e6e6e6;
        }

        #chat-input {
            display: flex;
        }

        #chat-input input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-right: 10px;
        }

        #chat-input button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        #chat-input button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    
    <?php include("usernav.php"); ?>

    <div style="display: flex; flex-grow: 1;">
        <div class="sidebar">
            <h2>Books</h2>
            <ul id="book-list">
                <?php
                $studentquery = "SELECT * FROM `read_tab` WHERE readers_name='$studentname'";
                $studentresult = mysqli_query($con, $studentquery);
                if (mysqli_num_rows($studentresult) > 0) {
                    while ($row = mysqli_fetch_array($studentresult)) {
                        echo '<li onclick="openChat(\'' . htmlspecialchars($row['book_name']) . '\')">' . htmlspecialchars($row['book_name']) . '</li>';
                    }
                } else {
                    echo '<li>No books found.</li>';
                }
                ?>
            </ul>
        </div>

        <div class="chat-area">
            <div id="chat-window">
                <h3 id="chat-title">Select a Book to Start Chat</h3>
                <h6 class="book-name" id="book-name">Book Name: </h6>
                <div id="messages"></div>
                <div id="chat-input">
                    <input type="text" id="message-input" placeholder="Type a message..." />
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const messagesContainer = document.getElementById('messages');

        function openChat(bookName) {
            const chatTitle = document.getElementById('chat-title');
            const bookNameElement = document.getElementById('book-name');
            chatTitle.textContent = `Chat for ${bookName}`;
            bookNameElement.textContent = `Book Name: ${bookName}`;
            messagesContainer.innerHTML = ''; // Clear previous messages
            
            // Load messages for the selected book
            $.get('get_chat_messages.php', { book_name: bookName }, function(data) {
                data.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = message.sender === '<?php echo $studentname; ?>' ? 'sent' : 'received';
                    messageElement.innerHTML = `<span class="chat-sender">${message.sender}:</span> <span class="chat-text">${message.message}</span>`;
                    messagesContainer.appendChild(messageElement);
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll to bottom
            }, 'json');
        }

        function sendMessage() {
            const input = document.getElementById('message-input');
            const message = input.value.trim();
            const bookName = document.getElementById('book-name').textContent.replace('Book Name: ', '').trim();

            if (message) {
                $.post('', {
                    message: message,
                    bookname: bookName,
                    insert: true
                }, function(response) {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'sent';
                    messageElement.innerHTML = `<span class="chat-sender">You:</span> <span class="chat-text">${response.message}</span>`;
                    messagesContainer.appendChild(messageElement);
                    input.value = ''; // Clear input
                    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll to bottom
                }, 'json');
            }
        }
    </script>
</body>
</html>

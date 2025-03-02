<?php
session_start();
include("connection.php");

$username = $_SESSION['username'];
$query = "SELECT * FROM `read_tab` WHERE mentor_name='$username' and read_status='Finished' ";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="yourrecommendationstylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Your Requests</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <div class="list-table">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>Book Name</th><th>Readers Name</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['book_name'] . '</td>';
                echo '<td>' . $row['readers_name'] . '</td>';
                echo '<td>
                    <form method="GET" action="chat.php">
                        <input type="hidden" name="bookname" value="' . htmlspecialchars($row['book_name']) . '">
                        <input type="hidden" name="readers_name" value="' . htmlspecialchars($row['readers_name']) . '">
                        <input type="submit" value="Conduct Exam">
                    </form>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Students havent finished </p>';
        }
        ?>
    </div>
</body>
</html>

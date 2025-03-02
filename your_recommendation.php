<?php
session_start();
include("connection.php");

$username = $_SESSION['username'];
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'book_name';
$query = "SELECT * FROM `read_tab` WHERE mentor_name='$username'  ORDER BY $sort_option";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="yourrecommendationstylesheet.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Your Requests</title>
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="list-table">
        <form method="GET" action="">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort">
                <option value="book_name">Book Name</option>
                <option value="readers_name">Readers Name</option>
            </select>
            <input type="submit" value="Sort">
        </form>

        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>Book Name</th><th>Readers Name</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['book_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['readers_name']) . '</td>';
                echo '<td>
                    <form method="GET" action="chat.php">
                        <input type="hidden" name="bookname" value="' . htmlspecialchars($row['book_name']) . '">
                        <input type="hidden" name="readers_name" value="' . htmlspecialchars($row['readers_name']) . '">
                        <input type="submit" value="Chat">
                    </form>
                    <form method="GET" action="student_review.php">
                        <input type="hidden" name="bookname" value="' . htmlspecialchars($row['book_name']) . '">
                        <input type="hidden" name="readers_name" value="' . htmlspecialchars($row['readers_name']) . '">
                        <input type="submit" value="Reviews">

                    </form>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No recommendations found.</p>';
        }
        ?>
    </div>
</body>

</html>
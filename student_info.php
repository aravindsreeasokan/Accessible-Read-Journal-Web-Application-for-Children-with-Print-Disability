<?php
session_start();
include("connection.php");

$username = $_SESSION['username'];
$query = "SELECT * FROM `login_tab` WHERE role='user' ";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="studentinfostylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Your Requests</title>
</head>
<body>
    <?php include("adminnav.php");
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>Readers Name</th><th>Serial No</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['roll_no']) . '</td>';
                echo '<td>
                    <form method="GET" action="student_details.php">
                        <input type="hidden" name="studentname" value="' . htmlspecialchars($row['username']) . '">
                        <input type="hidden" name="roll_no" value="' . htmlspecialchars($row['roll_no']) . '">
                        <input type="submit" value="Update Details">
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

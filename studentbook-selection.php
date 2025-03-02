<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="studentbookselectionstylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>
<?php 
        include("usernav.php");
        include("connection.php");
        include("book_chat.php");
        $studentname = $_SESSION['username'];
        $studentquery = "SELECT * FROM `read_tab` where readers_name='$studentname'";
        $studentresult = mysqli_query($con, $studentquery);
        if (mysqli_num_rows($studentresult) > 0) {
            echo '<table>';
            echo '<tr><th>Mentors Name</th><th>Book Name</th><th>Action</th></tr>';
            while ($row = mysqli_fetch_array($studentresult)) {
                echo '<tr>';
                echo '<td>' . $row['mentor_name'] . '</td>';
                echo '<td>' . $row['book_name'] . '</td>';
                echo '<td>
                    <form method="GET" action="studentchat.php">
                        <input type="hidden" name="book_name" value="' . $row['book_name'] . '">
                        <input type="hidden" name="studentname" value="' . $row['readers_name'] . '">
                        <input type="hidden" name="student" value="' . $studentname . '">
                        <input type="submit" value="chat">
                    </form>
                      </td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
             echo '<div style="color: red; font-weight: bold; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px;">No Chat to show.</div>';
            ;
        }
    ?>
    
    
</body>
</html>
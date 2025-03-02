<?php

include("connection.php");
$serialno=$_POST['serialno'];
$bookname=$_POST['bookname'];
$studentname=$_POST['studentname'];
$studentrollno=$_POST['studentrollno'];
$review=$_POST['review'];
$query = "INSERT INTO `review_tab` (serial_no, bookname, student_name, student_rollno, review)
              VALUES ('$serialno', '$bookname', '$studentname', '$studentrollno', '$review')";
    if (mysqli_query($con, $query)) {
        echo "Review successfully submitted!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }


?>
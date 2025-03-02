
<?php
session_start();
include("connection.php");
    if (isset($_POST['serialno'], $_POST['bookname'])) {
        $serial_no = $_POST['serialno'];
        $bookname = $_POST['bookname'];
        $studentname = $_POST['studentname'];
        $studentmail = $_POST['studentmail'];
        $rollno = $_POST['rollno'];
        $username = $_SESSION['username']; 
        $insertquery = "INSERT INTO `recommend_tab` (student_name,roll_no,book_name, serialno, recommenders_name) 
                        VALUES ('$studentname','$rollno','$bookname', '$serial_no', '$username')";
        $requestresult = mysqli_query($con, $insertquery);
        if ($requestresult) {
            echo "Recommendation added successfully";
        }
        else {
        echo "Failed to send recommendation.";
        } 
    }
?>

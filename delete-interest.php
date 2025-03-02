<?php
session_start();
include("connection.php");
$serialno = $_SESSION['roll_no'];
$query = "UPDATE `student_details_tab` SET interest = '' WHERE student_rollno = '$serialno'";
$result = mysqli_query($con, $query);

if ($result) {
    echo "All Interest Cleared ";
} else {
    echo "Failed to delete interests.";
}
?>

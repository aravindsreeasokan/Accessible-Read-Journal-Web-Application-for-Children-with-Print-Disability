<?php
include("connection.php");
session_start();
$username=$_SESSION['username'];
$serial_no=$_POST['serialno'];
$book_name=$_POST['bookname'];
$mentor_name=$_POST['mentorname'];
$query="UPDATE  `read_tab` SET read_status='finished' where serial_no='$serial_no' and readers_name='$username'";
$result=mysqli_query($con,$query);
if($result)
{
    echo " Status Updated To Finished";
}
?>
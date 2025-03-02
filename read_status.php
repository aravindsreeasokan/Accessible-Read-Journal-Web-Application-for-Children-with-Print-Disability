<?php
session_start();
$studentname=$_SESSION['username'];
$serial_no=$_POST['serialno'];
$book_name=$_POST['bookname'];
$pages=$_POST['page_read'];
$status=$_POST['status'];
include("connection.php");
$query="UPDATE `read_tab` SET read_status='$status' where serial_no='$serial_no' and readers_name='$studentname'";
$result=mysqli_query($con,$query);
if($result)
{
        echo "Status Updated";
}
?>
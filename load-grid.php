<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">  </script>
<
<script>Aler("load-grid");</script>
<?php
$serial_no = $_POST['searialno'];
$username = $_SESSION['username'];
$bookname = $_POST['bookname'];
$bookowner=$_POST['ownername'];
$insertquery = "INSERT INTO request_tab (request_datetime, serial_no, book_name,ownername, requester_name, request_status) 
                VALUES (NOW(), '$serial_no', '$bookname','$bookowner', '$username', '0')";
$requestresult = mysqli_query($con, $insertquery);

?>
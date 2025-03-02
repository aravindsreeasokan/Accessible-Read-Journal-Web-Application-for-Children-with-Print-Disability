<?php
include("connection.php");
$request_no=$_POST['countnew'];
echo 'alert($request_no)';
$query = "UPDATE request_tab SET request_status = '1' WHERE request_no ='$request_no'";
$result = mysqli_query($con, $query);
if ($result) {
    echo '<p>Action completed successfully ajax.</p>';
} else {
    echo '<p>Failed to complete action: ajax ' . mysqli_error($con) . '</p>';
}
?>
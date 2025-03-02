<?php
    include("connection.php");
    $requestno = $_POST['requestno'];
    //echo $requestno;
    $query = "DELETE FROM request_tab WHERE request_no = '$requestno'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo 'Request Deleted';
    } 
?>
<?php
    //echo "hey";
    include("connection.php");
    $request_no = $_POST['requestno'];
    $serial_no = $_POST['serialno'];
    $query = "UPDATE request_tab SET request_status = '1' WHERE request_no ='$request_no'";
    $result = mysqli_query($con, $query);
    $updatecopyquery = "UPDATE book_details_tab SET no_of_copies = no_of_copies - 1 WHERE serial_no = '$serial_no'";
    $updateresult=mysqli_query($con,$updatecopyquery);
    if ($result ) {
         echo 'Request accepted';
            if($updateresult)
            {
                //echo '<p>Copy updated</p>';
            }
    } 
?>
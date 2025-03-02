<?php
include("connection.php");
$action=$_POST['action'];
if(isset($_POST['request_no'])) {
    if (isset($_POST['action'])) {
        $request_no = $_POST['request_no'];
        $action = $_POST['action'];
        if ($action === 'Accept') {
            $query = "UPDATE request_tab SET request_status = '1' WHERE request_no ='$request_no'";
        } elseif ($action === 'Delete') {
            $query = "DELETE FROM request_tab WHERE request_no = '$request_no'";
        } elseif ($action === 'Reject') {
            $query = "UPDATE request_tab SET request_status = '0' WHERE request_no ='$request_no'";
        }
        $result = mysqli_query($con, $query);
        if ($result) {
            echo '<p>Action completed successfully.</p>';
        } else {
            echo '<p>Failed to complete action: ' . mysqli_error($con) . '</p>';
        }
    }
    //insert();
}
function insert() {
    include("connection.php");
    $request_no = $_POST['request_no'];
    $stmt = $con->prepare("UPDATE request_tab SET request_status = '1' WHERE request_no = ?");
    $stmt->bind_param("i", $request_no);
    if ($stmt->execute()) {
        echo 'Action completed successfully.';
    } else {
        echo 'Failed to complete action: ' . $stmt->error;
    }
    $stmt->close();
}
?>

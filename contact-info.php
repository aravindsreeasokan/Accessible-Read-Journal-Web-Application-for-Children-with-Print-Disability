<?php
include("connection.php");

if (isset($_POST['ownername'])) {
    $ownername = $_POST['ownername'];
    $query = "SELECT * FROM `login_tab` WHERE username = '$ownername'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo '<p>Name: ' . $row['username'] . '</p>';
        echo '<p>Phone No: ' . $row['phoneno'] . '</p>';
        echo '<p>Email: ' . $row['email'] . '</p>';
        echo '<p>Place: ' . $row['place'] . '</p>';
    } else {
        echo '<p>No contact information found.</p>';
    }
}
?>

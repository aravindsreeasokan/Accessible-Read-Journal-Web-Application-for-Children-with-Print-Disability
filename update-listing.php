<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serialno = $_POST['serialno'];
    $ownername = $_POST['ownername'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $place = $_POST['place'];
    $price = $_POST['price'];
    $copies = $_POST['copies'];

    // Update the listing in the database
    $query = "UPDATE book_details_tab SET book_name = '$name', category = '$category', Place = '$place', price = '$price',no_of_copies = '$copies' WHERE serial_no = '$serialno' AND owners_name = '$ownername'";
    if (mysqli_query($con, $query)) {
        echo "Listing updated successfully.";
    } else {
        echo "Error updating listing: " . mysqli_error($con);
    }
}
?>

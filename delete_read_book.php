<?php
session_start();
include("connection.php");

$username = $_SESSION['username'];
$serial_no = $_POST['serialno'];
$book_name = $_POST['bookname'];
$mentor_name = $_POST['mentorname'];

// Delete the book entry from read_tab
$query = "DELETE FROM `read_tab` 
          WHERE serial_no = '$serial_no'
          AND book_name = '$book_name'
          AND readers_name = '$username'
          AND mentor_name = '$mentor_name'";
$result = mysqli_query($con, $query);

// Update the number of copies in book_details_tab for the specific book
$query2 = "UPDATE `book_details_tab` 
           SET no_of_copies = no_of_copies + 1
           WHERE book_name = '$book_name' and serial_no =$serial_no";
$result2 = mysqli_query($con, $query2);

if ($result && $result2) {
    echo "Book has been removed from bookshelf.";
} else {
    echo "Error in removing the book.";
}
?>

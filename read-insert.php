<?php
session_start();
include("connection.php");

if (isset($_POST['serialno'], $_POST['bookname'])) {
    $serial_no = $_POST['serialno'];
    $bookname = $_POST['bookname'];
    $mentorname = $_POST['mentorname'];
    $username = $_SESSION['username'];

    // Insert into read_tab
    $insertquery = "INSERT INTO `read_tab` (book_name, readers_name, mentor_name, serial_no, read_status) 
                    VALUES ('$bookname', '$username', '$mentorname', '$serial_no', 'To read')";
    $requestresult = mysqli_query($con, $insertquery);

    if ($requestresult) {
        // Update book details
        $updatecopyquery = "UPDATE book_details_tab SET no_of_copies = no_of_copies - 1 WHERE serial_no = '$serial_no'";
        $updateresult = mysqli_query($con, $updatecopyquery);

        if ($updateresult) {
            // Insert initial review entry
            /* $reviewquery = "INSERT INTO `daily_review_tab` (book_name, serial_no, readers_name, review, review_date, review_time, mentors_name) 
                            VALUES ('$bookname', '$serial_no', '$username', '', CURDATE(), CURTIME(), '$mentorname')";
            $reviewresult = mysqli_query($con, $reviewquery);*/

                if ($updateresult) {
                  echo "Book added to shelf ";
                } 
                else {
                    echo "Book added to shelf, but failed to initialize review entry.";
                }
       
        }
    } else {
        echo "Failed to add book to shelf.";
    }
}

<?php
    session_start();
    include("connection.php");

    $serialno = $_POST['serialno'];
    $rollno = $_SESSION['roll_no'];

    // Check if an entry already exists for the given serial number and roll number
    $check_query = "SELECT * FROM `attended_exam` WHERE book_id = '$serialno' AND student_id = '$rollno'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If an entry exists, increment the Number_of_attempt by 1
        $update_query = "UPDATE `attended_exam` SET Number_of_attempt = Number_of_attempt + 1 WHERE book_id = '$serialno' AND student_id = '$rollno'";
        mysqli_query($con, $update_query);
        echo "Answer added succesfully";
    } else {
        // If no entry exists, insert a new record with Number_of_attempt set to 1
        $insert_query = "INSERT INTO `attended_exam` (Number_of_attempt, book_id, student_id, status) VALUES ('1', '$serialno', '$rollno', 'ATTENDED')";
        mysqli_query($con, $insert_query);
        echo "Answer Submmitted succesfully";
    }
?>

<?php
session_start();
include("connection.php");
$student_id=$_SESSION['roll_no'];
$question_id=$_POST['q_id'];
$selected_option=$_POST['selected_option'];

            $insert_query = "INSERT INTO `student_answers_tab` (student_id, question_id, selected_option) 
                             VALUES ('$student_id', '$question_id', '$selected_option')";

            if (!mysqli_query($con, $insert_query)) {
                echo "Error: " . mysqli_error($con);
                exit();
            }
?>

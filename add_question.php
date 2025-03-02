<?php
include("connection.php");

// Retrieve data from the POST request
$serialno =  $_POST['serialno'];
$question_text = $_POST['question'];
$option_1 = $_POST['option_1'];
$option_2 = $_POST['option_2'];
$option_3 =  $_POST['option_3'];
$option_4 = $_POST['option_4'];
$correct_option =  $_POST['correct_option'];
$mentorname=$_POST['mentorname'];

// SQL query to insert the data into the questions_tab
$query = "INSERT INTO `questions_tab` (serialno, question_text, option_1, option_2, option_3, option_4, correct_option,mentors_name) 
          VALUES ('$serialno', '$question_text', '$option_1', '$option_2', '$option_3', '$option_4', '$correct_option','$mentorname')";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    echo "Question Added successfully!";
} else {
    echo "Error: " . mysqli_error($con);
}
?>

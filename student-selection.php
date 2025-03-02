<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
    $studentrollno = mysqli_real_escape_string($con, $_POST['student_rollno']);
    $mentor = mysqli_real_escape_string($con, $_POST['mentor']);

    // Insert into mentor_student_tab
    $studentcombinequery = "INSERT INTO `mentor_student_tab` (student_name, student_rollno, mentor_name) 
                            VALUES ('$student_name', '$studentrollno', '$mentor')";
    $combineresult = mysqli_query($con, $studentcombinequery);

    // Update the mentor name in student_details_tab
    $mentoradd = "UPDATE `student_details_tab` 
                  SET mentor_name = '$mentor' 
                  WHERE student_rollno = '$studentrollno'";
    $result = mysqli_query($con, $mentoradd);

    // Check if both queries were successful
    if ($combineresult && $result) {
        echo "Student Has Been Selected";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

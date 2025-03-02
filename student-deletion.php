<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
    $studentmail = mysqli_real_escape_string($con, $_POST['student_mail']);
    $mentor = mysqli_real_escape_string($con, $_POST['mentor']);

    // Delete from mentor_student_tab
    $studentcombinequery = "DELETE FROM `mentor_student_tab` WHERE student_name='$student_name' AND mentor_name='$mentor'";
    $combineresult = mysqli_query($con, $studentcombinequery);
    $studentrecommenddeletequery = "DELETE FROM `recommend_tab` WHERE student_name='$student_name' AND recommenders_name='$mentor'";
    $recommenddeleteresult = mysqli_query($con, $studentrecommenddeletequery);

    $studentreaddeletequery = "DELETE FROM `read_tab` WHERE readers_name='$student_name' AND mentor_name='$mentor'";
    $readdeleteresult = mysqli_query($con, $studentreaddeletequery);


    // Update mentor_name to NULL in student_details_tab
    $updateMentorQuery = "UPDATE `student_details_tab` SET mentor_name=NULL WHERE student_name='$student_name'";
    $updateMentorResult = mysqli_query($con, $updateMentorQuery);

    if ($combineresult && $updateMentorResult&&$recommenddeleteresult&&$studentreaddeletequery) {
        echo "Student and mentor details updated successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

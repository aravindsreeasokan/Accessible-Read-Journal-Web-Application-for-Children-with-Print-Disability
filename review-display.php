<?php
include("connection.php");
$serialno = $_POST['serialno'];
$bookname = $_POST['bookname'];
//echo("$serialno");
$query = "SELECT * FROM `review_tab` WHERE serial_no='$serialno'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="review-container">';
        // Display the review
        echo '<p class="revieww">' . htmlspecialchars($row['review']) . '</p>';
        // Display the student's name in the bottom right corner
        echo '<p class="student-name">' . htmlspecialchars($row['student_name']) . '</p>';
        echo '</div>';
    }
} else {
    echo "<p>No reviews from users.</p>";
}
?>

<style>
    .review-container {
        position: relative;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        margin-bottom: 20px;
        background-color: #f9f9f9; /* Light background for the container */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
        transition: transform 0.2s ease; /* Smooth hover effect */
    }

    .review-container:hover {
        transform: scale(1.02); /* Slight zoom-in effect on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Stronger shadow on hover */
    }

    .revieww {
        font-size: 16px;
        line-height: 1.6;
        color: #333; /* Darker text color for readability */
        font-family: 'Arial', sans-serif; /* Clean font for readability */
        margin-bottom: 40px; /* Space for the student's name */
    }

    .student-name {
        position: absolute;
        bottom: 0;
        right: 10px;
        font-size: 14px;
      
        font-weight: bold;
        font-family: 'Arial', sans-serif; /* Same font for consistency */
    }

    .student-name::before {
        content: "— "; /* Prepend a dash before the student's name */
    }
</style>

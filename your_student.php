<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="yourstudentstyle.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Manage Students</title>
</head>
<body>
    <?php 
        include("nav.php");
        include("connection.php");

        $mentorname = $_SESSION['username'];
        echo '<div class="container">';
        echo '<h1>Manage Students</h1>';

        $studentquery = "SELECT * FROM `student_details_tab` WHERE mentor_name='$mentorname'";
        $studentresult = mysqli_query($con, $studentquery);

        if (mysqli_num_rows($studentresult) > 0) {
            echo '<table class="table table-striped table-hover">';
            echo '<tr><th>Student Name</th><th>Roll No</th><th>Age</th><th>Disability</th><th>Interest</th><th>Action</th></tr>';
            while ($row = mysqli_fetch_array($studentresult)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['student_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['student_rollno']) . '</td>';
                echo '<td>' . htmlspecialchars($row['age']) . '</td>';
                echo '<td>' . htmlspecialchars($row['disability']) . '</td>';
                echo '<td>' . htmlspecialchars($row['interest']) . '</td>';
                echo '<td>
                        <form name="recommend" method="GET" action="recommend_a_book.php" style="display:inline-block;">
                            <input type="hidden" name="studentname" value="' . htmlspecialchars($row['student_name']) . '">
                            <input type="hidden" name="email" value="' . htmlspecialchars($row['student_mail']) . '">
                            <input type="hidden" name="disability" value="' . htmlspecialchars($row['disability']) . '">
                            <input type="hidden" name="interest" value="' . htmlspecialchars($row['interest']) . '">
                            <input type="hidden" name="rollno" value="' . htmlspecialchars($row['student_rollno']) . '">
                            <input type="hidden" name="mentor" value="' . htmlspecialchars($mentorname) . '">
                            <input type="submit" value="Recommend" class="btn-recommend">
                        </form>
                        <input type="hidden" class="studentname" value="' . htmlspecialchars($row['student_name']) . '">
                        <input type="hidden" class="email" value="' . htmlspecialchars($row['student_mail']) . '">
                        <input type="hidden" class="mentor" value="' . htmlspecialchars($mentorname) . '">
                        <button class="delete-btn">Delete</button>
                    </td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="no-students">No students found.</p>';
        }
        echo '</div>';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.delete-btn').click(function(event) {
            event.preventDefault();
            var row = $(this).closest('tr');
            var email = row.find('.email').val();
            var student_name = row.find('.studentname').val();
            var mentor = row.find('.mentor').val();

            $.ajax({
                url: "student-deletion.php",
                type: "POST",
                data: { student_name: student_name, student_mail: email, mentor: mentor },
                success: function(data) {
                    alert(data);
                    location.reload();
                    row.remove(); // Remove row from table on successful deletion
                },
                error: function(xhr, status, error) {
                    alert("Error sending request: " + xhr.responseText);
                }
            });
        });
    });
    </script>
</body>
</html>

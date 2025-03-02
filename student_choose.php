<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="studentchoosestyle.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php 
        include("nav.php");
        include("connection.php");
        $mentorname = $_SESSION['username'];
        $studentquery = "SELECT * FROM `student_details_tab` where student_name NOT IN(SELECT student_name from `mentor_student_tab` ) ";
        $studentresult = mysqli_query($con, $studentquery);
        if (mysqli_num_rows($studentresult) > 0) {
            echo '<table>';
            echo '<tr><th>Student Name</th><th>Roll No</th><th>Disability</th><th>Age</th><th>Interest</th><th>Action</th></tr>';
            while ($row = mysqli_fetch_array($studentresult)) {
                echo '<tr>';
                echo '<td>' . $row['offical_name'] . '</td>';
                echo '<td>' . $row['student_rollno'] . '</td>';
                echo '<td>' . $row['disability'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>' . $row['interest'] . '</td>';
                echo '<td>
                        <input type="hidden" class="rollno" value="' . $row['student_rollno'] . '">
                        <input type="hidden" class="studentname" value="' . $row['student_name'] . '">
                        <input type="hidden" class="mentor" value="' . $mentorname . '">
                        <button class="choose-btn">Choose</button>
                      </td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No students found.';
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.choose-btn').click(function(event) {
            event.preventDefault();
            var row = $(this).closest('tr');
            var rollno = row.find('.rollno').val();
            var student_name = row.find('.studentname').val();
            var mentor = row.find('.mentor').val();

            $.ajax({
                url: "student-selection.php",
                type: "POST",
                data: { student_name: student_name, student_rollno: rollno, mentor: mentor },
                success: function(data) {
                    alert(data);
                    location.reload();
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

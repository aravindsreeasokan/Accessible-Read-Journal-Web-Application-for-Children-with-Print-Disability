<?php
    session_start();
    include_once('adminnav.php');
    include("connection.php");

    // Fetch student details based on roll number from GET request
    $rollno = isset($_GET['roll_no']) ? $_GET['roll_no'] : '';

    // Fetch student data if roll number is passed
    $student = null;
    if ($rollno) {
        $query = "SELECT * FROM `student_details_tab` WHERE student_rollno='$rollno'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_assoc($result);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="student_details_style.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Update Student</title>
    <style>
        .container {
            position: relative; /* For the absolute positioned PDF icon */
            max-width: 600px; /* Adjust width to your design needs */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 8px; /* Optional rounded corners */
        }

        /* Style for the PDF download icon */
        .pdf-download {
            position: absolute;
            top: 10px; /* Adjust the vertical distance */
            right: 10px; /* Adjust the horizontal distance */
            font-size: 30px;
            color: red;
            text-decoration: none;
        }

        .pdf-download:hover {
            color: darkred;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input, form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- PDF Download Icon -->
            <?php if ($rollno): ?>
                <a href="generate_student_pdf.php?roll_no=<?php echo $rollno; ?>" target="_blank" title="Download PDF" class="pdf-download">
                    <i class='bx bxs-file-pdf'></i> <!-- PDF Icon -->
                </a>
            <?php endif; ?>

            <h2>Enter Student Details</h2>
            <form name="student_details" method="POST" action="" enctype="multipart/form-data">
                <label for="student_rollno">Roll Number:</label>
                <input type="text" id="student_rollno" name="student_rollno" value="<?php echo $student['student_rollno'] ?? ''; ?>" required>

                <label for="student_name">Name:</label>
                <input type="text" id="student_name" name="student_name" value="<?php echo $student['student_name'] ?? ''; ?>" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $student['age'] ?? ''; ?>" required>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo $student['location'] ?? ''; ?>" required>

                <label for="disability">Disability:</label>
                <select id="disability" name="disability" required>
                    <option value="visual" <?php echo (isset($student['disability']) && $student['disability'] == 'visual') ? 'selected' : ''; ?>>Visual</option>
                    <option value="learning" <?php echo (isset($student['disability']) && $student['disability'] == 'learning') ? 'selected' : ''; ?>>Learning</option>
                    <option value="physical" <?php echo (isset($student['disability']) && $student['disability'] == 'physical') ? 'selected' : ''; ?>>Physical</option>
                    <option value="other" <?php echo (isset($student['disability']) && $student['disability'] == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>

                <label for="student_image">Student Image:</label>
                <input type="file" id="student_image" name="student_image">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>

    <?php
        if (isset($_POST['submit'])) 
        {
            $rollno = $_POST['student_rollno'];
            $studentname = $_POST['student_name'];
            $age = $_POST['age'];
            $location = $_POST['location'];
            $disability = $_POST['disability'];
            $image_name = $student['student_img'] ?? "default.png";

            // Handle student image upload
            if(isset($_FILES['student_image']) && $_FILES['student_image']['error'] == 0) {
                $image_name = $_FILES['student_image']['name'];
                $tempname = $_FILES['student_image']['tmp_name'];
                $folder = 'students_images/' . $image_name;

                if (!move_uploaded_file($tempname, $folder)) {
                    echo "<script>alert('Failed to upload student image.');</script>";
                }
            }

            // Check if the student exists and update the record
            $existquery = "SELECT * FROM `student_details_tab` WHERE student_rollno='$rollno'";
            $result = mysqli_query($con, $existquery);

            if (mysqli_num_rows($result) > 0) {
                // Update existing student details
                $updatequery = "UPDATE `student_details_tab` 
                                SET student_name='$studentname', age='$age', location='$location', disability='$disability', student_img='$image_name'
                                WHERE student_rollno='$rollno'";

                if (mysqli_query($con, $updatequery)) {
                    echo "<script>alert('Student details updated successfully.');</script>";
                    header('Location: adminhome.php');
                    exit();
                } else {
                    echo "<script>alert('Error: Unable to update student details.')</script>";
                }
            } else {
                // Insert new student details
                $signupquery = "INSERT INTO `student_details_tab` (student_rollno, student_name, age, location, disability, student_img) 
                                VALUES ('$rollno','$studentname','$age','$location','$disability','$image_name')";

                if (mysqli_query($con, $signupquery)) {
                    echo "<script>alert('Student added successfully.');</script>";
                    header('Location: student_info.php');
                    exit();
                } else {
                    echo "<script>alert('Error: Unable to add student.')</script>";
                }
            }
        }
    ?>
</body>
</html>

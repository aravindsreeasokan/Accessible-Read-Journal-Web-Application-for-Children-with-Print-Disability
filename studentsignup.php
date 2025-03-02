<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="stylesheet1.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Add Student</title>
</head>
<body>
    <?php include("adminnav.php"); ?>   

    <div class="wrapper">
        <form name="signup" method="post" action="" onsubmit="return validateData()" enctype="multipart/form-data">
            <h1>Add Student <i class='bx bx-book-bookmark'></i></h1>

            <!-- Login details -->
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Roll No" name="rollno" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Phone No" name="phoneno" required>
                <i class='bx bxs-phone-call'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email" name="email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <!-- Student details -->
            <div class="input-box">
                <input type="text" placeholder="Student Name" name="student_name" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="number" placeholder="Age" name="age" required>
                <i class='bx bxs-calendar'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Location" name="location" required>
                <i class='bx bxs-map'></i>
            </div>
            <div class="input-box">
                <select name="disability" required>
                    <option value="visual">Visual</option>
                    <option value="learning">Learning</option>
                    <option value="physical">Physical</option>
                    <option value="other">Other</option>
                </select>
                <i class='bx bxs-wheelchair'></i>
            </div>
            <div class="input-box">
                <input type="file" name="student_image">
                <i class='bx bxs-image'></i>
            </div>

            <!-- Mentor assignment -->
            <div class="input-box">
                <select name="mentor" required>
                    <option value="">Select intial Mentor</option>
                    <?php
                    include("connection.php");
                    $query = "SELECT username FROM `login_tab` WHERE role='mentor'";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['username']."'>".$row['username']."</option>";
                        }
                    }
                    ?>
                </select>
                <i class='bx bxs-user-check'></i>
            </div>

            <button type="submit" class="btn">Sign Up</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include("connection.php");

        // Login data
        $username = $_POST['username'];
        $rollno = $_POST['rollno'];
        $phoneno = $_POST['phoneno'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Student data
        $student_name = $_POST['student_name'];
        $age = $_POST['age'];
        $location = $_POST['location'];
        $disability = $_POST['disability'];
        $mentor = $_POST['mentor']; // Selected mentor
        $image_name="default.png";

        if (isset($_FILES['student_image']) && $_FILES['student_image']['error'] == 0) {
            $image_name = $_FILES['student_image']['name'];
            $tempname = $_FILES['student_image']['tmp_name'];
            $folder = 'students_images/' . $image_name;

            if (!move_uploaded_file($tempname, $folder)) {
                echo "<script>alert('Failed to upload student image.');</script>";
            }
        }

        // Check for existing email, username, or roll number in login_tab
        $existquery = "SELECT * FROM `login_tab` WHERE email='$email' OR username='$username' or roll_no='$rollno'";
        $existresult = mysqli_query($con, $existquery);
        if (mysqli_num_rows($existresult) > 0) {
            echo '<script>alert("User Data Already Exists");</script>';
        } else {
            // Insert into login_tab
            $signupquery = "INSERT INTO `login_tab` (username, roll_no, phoneno, email, password, role) 
                            VALUES ('$username', '$rollno', '$phoneno', '$email', '$password', 'user')";
            if (mysqli_query($con, $signupquery)) {
                // Insert into student_details_tab
                $student_query = "INSERT INTO `student_details_tab` (student_rollno, student_img, student_name, offical_name, student_mail, age, location, disability, mentor_name) 
                                  VALUES ('$rollno', '$image_name', '$username', '$student_name', '$email', '$age', '$location', '$disability', '$mentor')";
                if (mysqli_query($con, $student_query)) {
                    // Insert into mentor_student_tab
                    $mentor_student_query = "INSERT INTO `mentor_student_tab` (student_name, student_rollno, mentor_name) 
                                             VALUES ('$username', '$rollno', '$mentor')";
                    if (mysqli_query($con, $mentor_student_query)) {
                        echo '<script>alert("Student and mentor assignment added successfully.");</script>';
                        header('Location: adminhome.php');
                        exit();
                    } else {
                        echo '<script>alert("Error: Unable to assign mentor.");</script>';
                    }
                } else {
                    echo '<script>alert("Error: Unable to add student details.");</script>';
                }
            } else {
                echo '<script>alert("Error: Unable to create account.");</script>';
            }
        }
    }
    ?>

    <script>
        function validateData() {
            const email = document.forms["signup"]["email"].value;
            const phone = document.forms["signup"]["phoneno"].value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phonePattern = /^\d{10}$/;

            if(!phonePattern.test(phone)) {
                window.alert("Invalid Phone");
                return false;
            }
            if (!emailPattern.test(email)) {
                window.alert("Invalid Email");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

<?php
session_start();
ob_start(); // Start output buffering
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="loginstylesheet.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Login</title>
    <style>
        .accessibility-controls {
            position: fixed;
            top: 10px;
            right: 10px;
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .accessibility-controls button {
            margin: 2px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            background: #007bff;
            color: white;
            border-radius: 3px;
            font-size: 14px;
        }
        .accessibility-controls button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <?php include("loginnav.php"); ?>
    
    <div class='accessibility-controls'>
        <button onclick="adjustFontSize(2)">A+</button>
        <button onclick="adjustFontSize(-2)">A-</button>
    </div>
    
    <div class='login'>
        <div class='wrapper'>
            <form method='POST' action=''>
                <h1>Login <i class='bx bx-book-bookmark'></i></h1>
                <div class='input-box'>
                    <input type='text' name='email' placeholder='Email' required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class='input-box'>
                    <input type='password' name='password' placeholder='Password' required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class='remember'>
                    <select name='role'>
                        <option value='admin'>Admin</option>
                        <option value='mentor'>Mentor</option>
                        <option value='user' selected>User</option>
                    </select>
                </div>
                <button type='submit' class='btn'>Sign In</button>
                <div class='register'>
                </div>
            </form>
        </div>
    </div>

    <script>
        function adjustFontSize(change) {
            document.querySelectorAll('*').forEach(el => {
                let currentSize = window.getComputedStyle(el).fontSize;
                let newSize = (parseInt(currentSize) + change) + 'px';
                el.style.fontSize = newSize;
            });
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include("connection.php");
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $loginquery = "SELECT * FROM `login_tab` WHERE email='$email' AND password='$password' AND role='$role'";
        $result = mysqli_query($con, $loginquery);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $studentname=$_SESSION['username'];
            $_SESSION['email'] = $email;
            $_SESSION['roll_no'] = $row['roll_no'];
            
            if ($role == 'mentor') {
                header('Location: mentorhome.php');
                exit();
            } elseif ($role == 'user') {
                $mentorquery="SELECT mentor_name from `mentor_student_tab` where student_name='$studentname'";
                $mentorresult=mysqli_query($con, $mentorquery);
                if(mysqli_num_rows($mentorresult)>0)
                {
                    while ($row = mysqli_fetch_array($mentorresult))
                    {
                        $_SESSION['mentor']=$row['mentor_name'];
                    }
                }
                header('Location: userhome.php');
                exit();
            } elseif ($role == 'admin') {
                header('Location: adminhome.php');
                exit();
            }
        } else {
            echo "<script>alert('Invalid email or password')</script>";
        }
    }
    ob_end_flush();
    ?>
</body>

</html>

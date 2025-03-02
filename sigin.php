<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="stylesheet1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include("nav.php"); ?>
<div class='login'>
    <div class='wrapper'>
        <form method='POST' action='login.php'>
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
                    <option value='user'>User</option>
                </select>
            </div>
            <button type='submit' class='btn'>Sign In</button>
            <div class='register'>
                <p>Don't Have an account? <a href='signup.php'>Sign up</a></p>
            </div>
        </form>
    </div>
</div>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include("connection.php");
        session_start();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        
        // Sanitize input and use prepared statements for security
        
        $loginquery = "SELECT * FROM `login_tab` WHERE email='$email' AND password='$password' AND role='$role'";
        $result = mysqli_query($con, $loginquery);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $email;
            $_SESSION['location'] = $row['location']; // Adjust this based on your database structure
            $_SESSION['contact'] = $row['contact']; // Adjust this based on your database structure
            
            if ($role == 'mentor') {
                header('location: home.php');
                exit();
            } elseif ($role == 'user') {
                header('location: userhome.php');
                exit();
            } elseif ($role == 'admin') {
                header('location: adminhome.php');
                exit();
            }
        } else {
            echo "<script>alert('Invalid email or password')</script>";
        }
    }
?>
</body>
</html>

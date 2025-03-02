<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link  type="text/css" href="staff_signin_style.css" rel="stylesheet"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<head>
    <title>Sign In</title>
</head>
<body>
    
    <div class="wrapper">
        <form method="POST" action="">
            <h1> Staff Login <i class='bx bx-book-bookmark'></i></h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email"  required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember">
                <label><input type="checkbox" >Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Sign In</button>
            <!--<div class="register ">
                <p>Don't Have an account? <a href="signup.php">Sign up</a></p>
            </div>-->
        </form>
    </div>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
            include("connection.php");
            $email=$_POST['email'];
            $password=$_POST['password'];
            $loginquery="SELECT * from `staff_login_tb` where staffemail='$email' and staffpassword='$password'";
            $result=mysqli_query($con,$loginquery);
            if(mysqli_num_rows($result)>0)
            {
                header('location:staff.php');
                exit();
            }
            /*else{
                echo "<p>Invalid email or password.</p>";
            }*/
    }
?>
</body>
</html>

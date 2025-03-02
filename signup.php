<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link  type="text/css" href="stylesheet1.css" rel="stylesheet"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<head>
    <title>Sign Up</title>
    
</head>
<body>
<?php
        include("adminnav.php");
?>   
    <div class="wrapper">
        <form  name="signup" method="post" action="" onsubmit="return validateData()">
            <h1>Add Mentor <i class='bx bx-book-bookmark'></i></h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="int" placeholder="College id " name="rollno" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Phone No" name="phoneno" required>
                <i class='bx bxs-phone-call' ></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email"  name="email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            
            <button type="submit" class="btn">Sign Up</button>
        </form>
    </div>
<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST') 
     {
             include("connection.php");
             $username=$_POST['username'];
             $rollno=$_POST['rollno'];
             $phoneno=$_POST['phoneno'];
             $email=$_POST['email'];
             $password = $_POST['password'];
             $existquery="SELECT * from `login_tab` where email='$email'";
             $existresult=mysqli_query($con,$existquery);
             if(mysqli_num_rows($existresult)>0)
             {
                echo '<script>alert("Email Already Exist")</script>';
                
             }
             $existquery="SELECT * from `login_tab` where username='$username'";
             $existresult=mysqli_query($con,$existquery);
             if(mysqli_num_rows($existresult)>0)
             {
                echo '<script>alert("User Name Already Exist")</script>';
             }
             else
             {
                    $signupquery="INSERT INTO `login_tab` (username,roll_no, phoneno, email,password,role) VALUES ('$username','$rollno','$phoneno','$email','$password','mentor')";
                    if (mysqli_query($con, $signupquery)) 
                    {

                        header('Location: adminhome.php');
                        exit();
                    } 
                    else 
                    {
                        echo '<script>alert("Error:  ")</script>';
                    }
             }
    }
?>
<script>
        function validateData() 
        {
            const email = document.forms["signup"]["email"].value;
            const phone = document.forms["signup"]["phoneno"].value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phonePattern = /^\d{10}$/;
            if(!phonePattern.test(phone))
            {
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

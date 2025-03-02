<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <?php
    $nameErr=$mobileErr=$dobErr=$emailErr=$genderErr=$passwordErr="";
    $name=$mobile=$dob=$email=$gender=$password="";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(empty($_POST["name"]))
        {
            $nameErr="Name is a required field";
        }
        else
        {
            $name=test_input($_POST["name"]);
            if(!preg_match("/^[a-zA-Z ]*$/",$name))
            {
                $nameErr="only letters and white spaces are allowed";
            }
        }

        if(empty($_POST["mobile"]))
        {
            $mobileErr="mobile is a required field";
        }
        else
        {
            $mobile=test_input($_POST["mobile"]);
            if(!preg_match("/^[0-9]{10}$/",$mobile))
            {
                $mobileErr="10 letters are needed";
            }
        }
        
        if(empty($_POST["email"]))
        {
            $emailErr="email is a required field";
        }
        else
        {
            $email=test_input($_POST["email"]);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $emailErr="it should in correct format";
            }
        }

        if(empty($_POST["dob"]))
        {
            $dobErr="dob is a required field";
        }
        else
        {
            $dob=test_input($_POST["dob"]);
        }

        if(empty($_POST["gender"]))
        {
            $genderErr="gender is a required field";
        }
        else
        {
            $gender=test_input($_POST["gender"]);
        }

        if(empty($_POST["password"]))
        {
            $passwordErr="password is a required field";
        }
        else
        {
            $password=test_input($_POST["password"]);
        }

    }
        function test_input($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
    ?> 
    <h2>REGISTRATION FORM </h2>
    <form method="POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
    Name : <input type="text" name ="name" ><span class="error">*<?php echo $nameErr ;?></span><br><br>
    Mobile : <input type="text" name ="mobile" ><span class="error">*<?php echo $mobileErr ;?></span><br><br>
    Email : <input type="text" name ="email" ><span class="error">*<?php echo $emailErr ;?></span><br><br>
    DOB : <input type="date" name ="dob" ><span class="error">*<?php echo $dobErr ;?></span><br><br>
    password : <input type="password" name ="password" ><span class="error">*<?php echo $passwordErr ;?></span><br><br>
    gender : <input type="radio" name="gender" value="female"> Female <input type="radio" name="gender" value="male"><span class="error"> Male*<?php echo $genderErr ;?></span> <br><br>
    Hobbie : <input type="checkbox" name="hobbies[]" value="reading">Reading 
    <input type="checkbox" name="hobbies[]" value="dancing">Dancing<br><br>
    <input type="submit"><br><br>
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST" && empty($nameErr) && empty($mobileErr) && empty($dobErr) && empty($emailErr) && empty($passwordErr)
     && empty($genderErr)) 
    {
      echo "<h3> your input <br></h3> Name : $name  <br> mobile : $mobile <br> email : $email <br> dob : $dob <br> gender : $gender 
      <br> Password :".str_repeat("*",strlen($password));
      if($_POST["hobbies"] )
      {
        echo " <br>hobbies :".implode(",",$_POST["hobbies"]);
      }
      else
      {
        echo "Hobby not found";
      }
    }
    ?>  
</body>
</html>

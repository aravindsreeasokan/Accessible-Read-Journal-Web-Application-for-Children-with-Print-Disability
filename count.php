<?php
include("connection.php");
if(isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
                $query = "SELECT * FROM `read_tab`  where mentor_name='$username' or readers_name='$username'";
                $countresult = mysqli_query($con, $query);
                $_SESSION['count']=mysqli_num_rows($countresult);
}
?>
<?php  
    $count=$_POST['countnew'];
        include("connection.php");
        $query="SELECT * from   request_tab LIMIT $count";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_array($result))
            {
                echo".$row[0] <br><br>";
                
                echo ".$row[1] <br><br>";
            }
        }
    ?>
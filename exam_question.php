<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="rentstylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Rent Book</title>
</head>
<body>
    <?php 
        session_start();
        include ('nav.php');
        include("connection.php"); 
        include_once 'examgrid.php';  
    ?>
 
    <div class="gridgallery">
        <?php
        $mentorname=$_SESSION['username'];
                $searchquery = "SELECT * FROM `book_details_tab` WHERE serial_no IN(SELECT serialno from `recommend_tab` where recommenders_name='$mentorname') or serial_no IN(SELECT serial_no from `read_tab` where mentor_name='$mentorname')";                     
                $result = mysqli_query($con, $searchquery);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        grid($row['serial_no'], $row['book_name'], $row['book_img'], $row['category'], $row['language'],$row['author_name']);
                    }
                } else {
                    echo "<div class='notfound'><p>NO RESULT</p></div>";
                }
        
        
            ?>
        </div>
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<!--<script src="js/bootstrap.js"></script>-->
</body>
</html>

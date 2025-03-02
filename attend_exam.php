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
        include ('usernav.php');
        include("connection.php"); 
        include_once 'attendgrid.php';  
    ?>
 
    <div class="gridgallery">
        <?php
        $studentname=$_SESSION['username'];
                $searchquery = "SELECT * FROM `book_details_tab` WHERE serial_no IN(SELECT serial_no from `read_tab` where readers_name='$studentname' and read_status='finished' )";                     
                $result = mysqli_query($con, $searchquery);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        grid($row['serial_no'], $row['book_name'], $row['book_img'], $row['category'], $row['language']);
                    }
                } else {
                    echo '<div style="color: #155724; font-weight: bold; padding: 15px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px;">Please Finish a book to attend exam</div>';

                }
        
        
            ?>
        </div>
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<!--<script src="js/bootstrap.js"></script>-->
</body>
</html>

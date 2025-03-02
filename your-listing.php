<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  type="text/css" href="yourlistingstylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Your Listing</title>
</head>
<?php
    include ("connection.php");
    include("nav.php");
    include("yourlistgrid.php");
?>

<body>
<div class="gridgallery">
    <?php
        $username=$_SESSION['username'];
        $searchquery = "SELECT * FROM `book_details_tab` WHERE owners_name='$username'";
                $result = mysqli_query($con, $searchquery);
                if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                yourlistgrid($row['serial_no'], $row['book_name'], $row['book_img'], $row['owners_name'], $row['category'], $row['language'], $row['Place'], $row['price']);
                }
                } else {
                echo "<div class='notfound'><p>NO RESULT</p></div>";
                }
                
                
    ?>
</div> 
</body>
</html>
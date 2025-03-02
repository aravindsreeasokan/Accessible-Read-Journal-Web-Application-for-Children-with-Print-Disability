<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  type="text/css" href="requeststylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <title>Request</title>
</head>
<body>
    <?php   
        session_start();
        include("connection.php");
    ?>
    <div id="table">
        <div class="requestform">
            <form name="request" method="POST" action="">
                <input type="text" name="searchinput">
                <input type="submit" class="searchbutton" name="search" id="searchbutton" value="Search Requests">
                <input type="submit" name="Accepted" id="acceptedbutton" value="Accepted Requests">
            </form>
        </div>

<?php
   include("connection.php");
   $username = $_SESSION['username'];
   if(isset($_POST['search'])) {
       $query = "SELECT * FROM `request_tab` WHERE ownername='$username' AND requester_name !='$username' AND request_status='0' ORDER BY request_datetime DESC";
       $result = mysqli_query($con, $query);
       if (mysqli_num_rows($result) > 0) {
           echo '<table>
                   <thead>
                       <th>Request Time</th>
                       <th>Book Name</th>
                       <th>Requester\'s Name</th>
                       <th>Action</th>
                   </thead>
                   <tbody>';
           while ($row = mysqli_fetch_array($result)) {
               echo '<tr>
                       <td>' . $row['request_datetime'] . '</td>
                       <td>' . $row['book_name'] . '</td>
                       <td>' . $row['requester_name'] . '</td>
                       <td>
                           <div id="confrimation">
                               <form method="post" action="" class="confirm-form">
                                   <input type="hidden" id="requestno" name="request_no" value="'. $row['request_no'] .'">
                                   <input type="button" id="acpt" class="accept" name="action" value="Accept">
                                   <input type="hidden" id="requestno" name="request_no" value="'. $row['request_no'] .'">
                                   <input type="button" id="dlt" class="delete" name="action" value="Delete">
                               </form>
                           </div>
                       </td>
                   </tr>';
           }
           echo '</tbody></table>';
       } else {
           echo '<p>No requests load found.</p>';
       }
   }

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    $('.accept').click(function(event) {
        event.preventDefault();
        var requestno = $(this).closest('form').find('#requestno').val(); 
       //alert(requestno);
        $.ajax({
            url: "load-acceptedtable.php",
            type: "POST",
            data: { requestno: requestno },
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $('.delete').click(function(event) {
        event.preventDefault();
        var requestno = $(this).closest('form').find('#requestno').val(); 
       //alert(requestno);
        $.ajax({
            url: "load-deletetable.php",
            type: "POST",
            data: { requestno: requestno },
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $('.reject').click(function(event) {
        event.preventDefault();
        var requestno = $(this).closest('form').find('#reject_no').val(); 
       //alert(requestno);
        $.ajax({
            url: "load-rejecttable.php",
            type: "POST",
            data: { requestno: requestno },
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
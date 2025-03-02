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
        include("nav.php");
        include("connection.php");
    ?>
    <div id="table">
        <div class="requestform">
            <form name="request" method="POST" action="">
                <input type="text" name="searchinput">
                <input type="submit" class="searchbutton" name="search" id="searchbutton" value="Requests for you">
                <input type="submit" name="Accepted" id="acceptedbutton" value="Accepted By You">
                <input type="submit" name="Onrent" id="onrentbutton" value="Books on Rent">
            </form>
        </div>
       <?php  
            $username = $_SESSION['username'];
            $query = "SELECT * FROM `request_tab` WHERE ownername='$username' AND requester_name !='$username' AND request_status='0' ORDER BY request_datetime DESC";
            $countresult = mysqli_query($con, $query);
            $_SESSION['count']=mysqli_num_rows($countresult);
            //echo $_SESSION['count'];
            if (isset($_POST['search'])) {
                $query = "SELECT * FROM `request_tab` WHERE ownername='$username' AND requester_name !='$username' AND request_status='0' ORDER BY request_datetime DESC";
                $result = mysqli_query($con, $query);
                mysqli_num_rows($result);
                
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
                                            <input type="hidden" id="serialno" name="serial_no" value="'. $row['serial_no'] .'">
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
                    echo '<p>No requests found.</p>';
                }
             }else if (isset($_POST['Accepted'])) {
                $query = "SELECT * FROM `request_tab` WHERE ownername='$username' AND requester_name !='$username' AND request_status='1' ORDER BY request_datetime DESC";
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
                                    <form method="post" action="">
                                        <input type="hidden" id="serialno" name="serial_no" value="'. $row['serial_no'] .'">
                                        <input type="hidden" id="reject_no" name="request_no" value="' . $row['request_no'] . '">
                                        <input type="submit" class="reject" name="action" value="Reject">
                                    </form>
                                </td>
                              </tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>No accepted requests found.</p>';
                }
            }else if (isset($_POST['Onrent'])) {
                $query = "SELECT * FROM `request_tab` WHERE ownername='$username' AND requester_name !='$username' AND request_status='1' ORDER BY request_datetime DESC";
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
                                    <form method="post" action="">
                                        <input type="hidden" id="serialno" name="serial_no" value="'. $row['serial_no'] .'">
                                        <input type="hidden" id="reject_no" name="request_no" value="' . $row['request_no'] . '">
                                        <input type="submit" class="bookreceived" name="action" value="Book Received">
                                    </form>
                                </td>
                              </tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>No Book is on rent.</p>';
                }
            }

        
        ?>
    </div>
<script>
/*function loadDoc() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("table").innerHTML = this.responseText;
  }
  xhttp.open("POST", "load-table.php",true);
  xhttp.send();
}
setInterval (function(){
    loadDoc();
},1000);
window.onload=loadDoc();*/
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
/*$(document).ready(function() {
    $('.searchbutton').click(function(event) {
        event.preventDefault();
        //var requestno = $(this).closest('form').find('#requestno').val(); 
       //alert(requestno);
        $.ajax({
            url: "load-table.php",
            type: "POST",
            data: { search: 'search' },
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});*/





$(document).ready(function() {
    $('.accept').click(function(event) {
        event.preventDefault();
        var requestno = $(this).closest('form').find('#requestno').val(); 
        var serialno = $(this).closest('form').find('#serialno').val(); 
        //alert(requestno);
        //alert(serialno);
        $.ajax({
            url: "load-acceptedtable.php",
            type: "POST",
            data: { requestno: requestno,serialno:serialno },
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
        var serialno = $(this).closest('form').find('#serialno').val(); 
        //alert(requestno);
       //alert(serialno);
        $.ajax({
            url: "load-rejecttable.php",
            type: "POST",
            data: { requestno: requestno,serialno:serialno },
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
    $('.bookreceived').click(function(event) {
        event.preventDefault();
        var requestno = $(this).closest('form').find('#reject_no').val();
        var serialno = $(this).closest('form').find('#serialno').val(); 
        //alert(requestno);
       //alert(serialno);
        $.ajax({
            url: "load-recievedbooktable.php",
            type: "POST",
            data: { requestno: requestno,serialno:serialno },
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
<!--script src="js/bootstrap.js"></script>-->
</body>
</html>

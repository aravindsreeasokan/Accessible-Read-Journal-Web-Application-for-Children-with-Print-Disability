<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <input type="submit" id="comment">
    </form>
    <div id="cmnt">
        <?php   
            include("connection.php");
            $query = "SELECT * from request_tab LIMIT 1";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    echo $row[0] . "<br><br>";
                    echo $row[1] . "<br><br>";
                }
            }
        ?>
    </div>
    <script>
        $(document).ready(function() {
            var count = 1;
            $('#comment').click(function(event) {
                event.preventDefault();
                count = count + 1;
                $("#cmnt").load("load-cmnt.php", { countnew: count });
            });
        });
    </script>
</body>
</html>

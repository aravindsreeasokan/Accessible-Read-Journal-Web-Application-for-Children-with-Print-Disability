<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="studentreviewstyle.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Review</title>
</head>
<?php
include("nav.php");
include("connection.php");

$bookname = $_GET['bookname'];
$readersname = $_GET['readers_name'];

echo "<h3 class='book-title'>Updates from " . htmlspecialchars($readersname) . "</h3>";

$reviewquery = "SELECT review, review_date FROM `daily_review_tab` WHERE readers_name='$readersname' AND book_name='$bookname'";
$result = mysqli_query($con, $reviewquery);
?>

<body>
    <div class="reviews-container">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='review-card'>";
                echo "<p class='review-text'>" . htmlspecialchars($row['review']) . "</p>";
                echo "<p class='review-date'>Reviewed on: " . htmlspecialchars($row['review_date']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-reviews'>No reviews found for this book.</p>";
        }
        mysqli_free_result($result);
        ?>
    </div>
</body>

</html>

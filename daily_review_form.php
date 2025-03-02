<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_review'])) {
        $book_name = $_POST['book_name'];
        $serial_no = $_POST['serial_no'];
        $readers_name = $_POST['readers_name'];
        $mentors_name = $_POST['mentors_name'];
        $review = mysqli_real_escape_string($con, $_POST['review']);
        $review_date = date('Y-m-d');
        $review_time = date('H:i:s');
    
        // Check if a review already exists for the given date
        $review_query = "SELECT * FROM daily_review WHERE book_name='$book_name' AND serial_no='$serial_no' AND readers_name='$readers_name' AND review_date='$review_date'";
        $review_result = mysqli_query($con, $review_query);
    
        if (mysqli_num_rows($review_result) > 0) {
            // Update existing review
            $update_query = "UPDATE daily_review SET review='$review', review_time='$review_time', mentors_name='$mentors_name' WHERE book_name='$book_name' AND serial_no='$serial_no' AND readers_name='$readers_name' AND review_date='$review_date'";
            mysqli_query($con, $update_query);
        } else {
            // Insert new review
            $insert_query = "INSERT INTO daily_review (book_name, serial_no, readers_name, review, review_date, review_time, mentors_name) 
                             VALUES ('$book_name', '$serial_no', '$readers_name', '$review', '$review_date', '$review_time', '$mentors_name')";
            mysqli_query($con, $insert_query);
        }
    
        // Refresh the page to reflect changes
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>
    
<body>
    <!-- Inside book shelf page loop for each book -->
<td>
    <form method="POST" action="">
        <input type="hidden" name="book_name" value="<?php echo htmlspecialchars($row['book_name']); ?>">
        <input type="hidden" name="serial_no" value="<?php echo htmlspecialchars($row['serial_no']); ?>">
        <input type="hidden" name="readers_name" value="<?php echo htmlspecialchars($username); ?>">
        <input type="hidden" name="mentors_name" value="<?php echo htmlspecialchars($row['mentor_name']); ?>">
        
        <?php
        // Fetch existing review for the book
        $review_query = "SELECT * FROM daily_review WHERE book_name='{$row['book_name']}' AND serial_no='{$row['serial_no']}' AND readers_name='$username' AND review_date=CURDATE()";
        $review_result = mysqli_query($con, $review_query);
        $review = mysqli_fetch_assoc($review_result);
        ?>
        
        <textarea name="review" class="form-control" rows="3"><?php echo htmlspecialchars($review['review'] ?? ''); ?></textarea>
        <button type="submit" name="submit_review" class="btn btn-primary mt-2">Submit Review</button>
    </form>
</td>

    
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="daily_review.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Daily Review</title>
</head>

<body>
    <?php
    include('usernav.php');
    $studentname = $_SESSION['username'];
    $rollno = $_SESSION['roll_no'];
    $serial_no = $_GET['serialno'];
    $book_name = $_GET['bookname'];
    include("connection.php");

    // Fetch mentor name
    $mentor = "SELECT mentor_name FROM mentor_student_tab WHERE student_name='$studentname' AND student_rollno='$rollno'";
    $mentorresult = mysqli_query($con, $mentor);
    if ($mentorresult) {
        $rw = mysqli_fetch_assoc($mentorresult);
        $mentor_name = $rw['mentor_name'];
    }

    // Fetch page number
    $page = "SELECT pages_read FROM read_tab WHERE readers_name = '$studentname' AND serial_no = '$serial_no' AND book_name='$book_name'";
    $result = mysqli_query($con, $page);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $pageno = $row['pages_read'];
    } else {
        $pageno = 0; // Default value if no result
    }
    echo "<div class='reviewload'>";
    // Fetch all reviews for this book and student
    $fetch_reviews = "SELECT review, review_date, review_time, pages_cmplted FROM daily_review_tab 
                      WHERE readers_name = '$studentname' AND serial_no = '$serial_no' AND book_name='$book_name' 
                      ORDER BY review_date DESC";
    $reviews_result = mysqli_query($con, $fetch_reviews);
    echo "</div>";
    // Initialize variables
    $review = '';
    $correctedReview = '';

    // Handle review correction
    if (isset($_POST['correct'])) {
        $review = $_POST['cont'];
        $pageno = $_POST['pag'];

        // Full path to the Node.js executable and script
        $nodePath = "C:\\Program Files\\nodejs\\node.exe"; // Adjust this path if necessary
        $scriptPath = "C:\\wamp64\\www\\Project\\mini - Copy\\rephrase.mjs"; // Adjust this path if necessary

        // Escape input for shell command
        $escapedReview = escapeshellarg($review);

        // Command to run the Node.js script
        $command = "\"$nodePath\" \"$scriptPath\" $escapedReview 2>&1";
        $output = shell_exec($command);

        // Capture the corrected review
        if ($output !== null) {
            $correctedReview = trim($output);
        } else {
            echo "<p><strong>Error:</strong> There was an issue running the command.</p>";
        }
    }

    // Handle review submission
    if (isset($_POST['sub'])) {
        $pageno = $_POST['pag'];
        $review = $_POST['cont'];
        
        // Insert review into database
        $insert = "INSERT INTO daily_review_tab (book_name, serial_no, pages_cmplted, readers_name, roll_no, review, review_date, review_time, mentors_name) 
                   VALUES ('$book_name', '$serial_no', '$pageno', '$studentname', '$rollno', '$review', NOW(), NOW(), '$mentor_name')";
        $resultinsert = mysqli_query($con, $insert);

        // Update pages read
        $pageinsert = "UPDATE read_tab SET pages_read='$pageno' WHERE book_name='$book_name' AND readers_name='$studentname'";
        $resultpage = mysqli_query($con, $pageinsert);
        header("Location: " . $_SERVER['PHP_SELF'] . "?serialno=$serial_no&bookname=$book_name");
        exit();
    }
    ?>

    <div class="container mt-4">
        <h4>Daily Book Journal: <?php echo htmlspecialchars($book_name); ?><a href="review_pdf_dwnld.php?serialno=<?php echo $serial_no; ?>&bookname=<?php echo urlencode($book_name); ?>" target="_blank">
        <i class='bx bxs-file-pdf'></i>
    </a></h4>

        <!-- Display previous reviews in a scrollable section -->
        <div class="previous-reviews mt-4">
            <h6>Journal History</h6>
            <div class="scrollable-reviews">
                <?php if (mysqli_num_rows($reviews_result) > 0): ?>
                    <ul class="list-group">
                        <?php while ($review_row = mysqli_fetch_assoc($reviews_result)): ?>
                            <li class="list-group-item">
                                <strong>Page <?php echo htmlspecialchars($review_row['pages_cmplted']); ?>:</strong>
                                <?php echo htmlspecialchars($review_row['review']); ?>
                                <br>
                                <small>Uploaded on <?php echo htmlspecialchars($review_row['review_date']); ?> </small>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No previous reviews found for this book.</p>
                <?php endif; ?>
            </div>
        </div>

        <form name='daily' method="POST" action="">
            <div class="page mt-4">
                <label for="page" class="form-label">Page Number:</label>
                <input type="number" class="form-control" name="pag" id="page" value="<?php echo htmlspecialchars($pageno); ?>">
            </div>
            <div class="review-area mt-3">
                <textarea class="form-control" name="cont" id="content" placeholder="Write your review here..."><?php echo htmlspecialchars($correctedReview ? $correctedReview : $review); ?></textarea>
                <div class="review-buttons">
                    <input type="submit" name="correct" class="btn btn-secondary" value="Modify Review">
                    <input type="submit" name="sub" class="btn btn-primary" value="Submit Review">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
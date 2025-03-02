<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="recommendstylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Recommend Book</title>
</head>
<body>
    <?php 
        session_start();
        include('nav.php');
        include("connection.php"); 
        include_once 'grid.php';  
        $studentname = $_GET['studentname'];
        $studentmail = $_GET['email'];
        $disability = $_GET['disability'];
        $interest = $_GET['interest'];
        $rollno = $_GET['rollno'];

        // Fetch the student's image
        $imgquery = "SELECT student_img FROM `student_details_tab` WHERE student_rollno = '$rollno'";
        $imgresult = mysqli_query($con, $imgquery);
        $imgrow = mysqli_fetch_assoc($imgresult);
        $studentimg = $imgrow ? $imgrow['student_img'] : 'default.png'; // Fallback image if not found
    ?>
    <div class="student-info">
        <div class="student-img">
            <img src="students_images/<?php echo htmlspecialchars($studentimg); ?>" alt="Student Image">
        </div>
        <div class="student-name">Name: <?php echo htmlspecialchars($studentname); ?></div>
        <div class="student-disability">Disability: <?php echo htmlspecialchars($disability); ?></div>
        <div class="student-interest">Interest: <?php echo htmlspecialchars($interest); ?></div>
        <div class="student-rollno">Roll No: <?php echo htmlspecialchars($rollno); ?></div>
    </div>
    <div class="search">
        <form name="searchform" action="" method="POST">
            <input type="text" name="searchbar" id="searchinput" placeholder="Search">
            <input type="submit" name="searchbutton" id="searchsubmit" value="Search">
        </form>
    </div>
    <div class="gridgallery">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['searchbutton'])) {
                $searchresult = $_POST['searchbar'];
                $searchresult = strtolower(mysqli_real_escape_string($con, $searchresult));
                $searchquery = "SELECT * FROM `book_details_tab` WHERE 
                                        (book_name LIKE '%$searchresult%' OR 
                                        author_name LIKE '%$searchresult%' OR 
                                        category LIKE '%$searchresult%' OR 
                                        language LIKE '%$searchresult%') 
                                        AND no_of_copies > 0
                                        ORDER BY RAND()";
                                    
                $result = mysqli_query($con, $searchquery);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        grid($row['serial_no'], $row['book_name'], $row['book_img'], $row['author_name'], $row['category'], $row['language'], $row['no_of_copies'], $studentname, $studentmail, $rollno);
                    }
                } else {
                    echo "<div class='notfound'><p>No results found for your search.</p></div>";
                }
            }
        } else {
            echo "<div class='recommendation-message'>Recommendations From System Based on Their Interests</div>";

            // Split the interests by commas
            $interestsArray = explode(',', $interest);
            
            // Initialize a flag to check if any results were found
            $resultsFound = false;

            // Store results to avoid duplicates
            $results = [];

            // Iterate through each interest
            foreach ($interestsArray as $singleInterest) {
                // Trim any whitespace around the interest
                $singleInterest = trim($singleInterest);

                // Construct the recommendation query using the single interest
                $recommendquery = "SELECT * FROM `book_details_tab` WHERE category LIKE '%$singleInterest%' AND no_of_copies > 0 ORDER BY RAND() LIMIT 3";

                // Execute the query
                $recommend = mysqli_query($con, $recommendquery);

                // Check if any results were returned
                if ($recommend && mysqli_num_rows($recommend) > 0) {
                    // Fetch and store each result to avoid duplicates
                    while ($row = mysqli_fetch_array($recommend)) {
                        $bookSerialNo = $row['serial_no'];
                        if (!in_array($bookSerialNo, $results)) {
                            $results[] = $bookSerialNo;
                            grid($row['serial_no'], $row['book_name'], $row['book_img'], $row['author_name'], $row['category'], $row['language'], $row['no_of_copies'], $studentname, $studentmail, $rollno);
                            $resultsFound = true;
                        }
                    }
                }
            }

            // If no results were found for any interest, display a message
            if (!$resultsFound) {
                echo "<div class='notfound'><p>No recommendations available based on your interests.</p></div>";
            }
        }
        ?>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--<script src="js/bootstrap.js"></script>-->
</body>
</html>

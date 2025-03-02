<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="rentstylesheet.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Rent Book</title>
    <style>
        /* Spinner animation styling */
        #loading {
            display: none;
            width: 50px;
            height: 50px;
            margin-left: 10px;
        }

        .custom-spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        #loading p {
            margin-top: 10px;
            font-size: 1rem;
            color: #3498db;
        }

        .search {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include('usernav.php');  
    include("connection.php"); 
    include_once 'readgrid.php';  
    ?>
    <div class="search">
        <form name="searchform" action="" method="POST">
            <input type="text" name="searchbar" id="searchinput" placeholder="Search">
            <input type="submit" name="searchbutton" id="searchsubmit" value="Search">
            <input type="file" name="image" id="imageupload" accept="image/*" style="display:none;">
            <input type="button" id="imagesubmit" value="Upload Image" onclick="document.getElementById('imageupload').click();">

            <!-- Loading message with spinner, now placed inside the search container -->
            <div id="loading">
                <div class="custom-spinner"></div>
            </div>
        </form>
    </div>

    <div class="gridgallery">
        <?php
        $studentname = $_SESSION['username'];
        $rollno = $_SESSION['roll_no'];

        // Fetch the student's mentor
        $mentorquery = "SELECT mentor_name FROM `mentor_student_tab` WHERE student_name='$studentname'";
        $mentorresult = mysqli_query($con, $mentorquery);
        if (mysqli_num_rows($mentorresult) > 0) {
            while ($row = mysqli_fetch_array($mentorresult)) {
                $mentorname = $row['mentor_name'];
            }
        }

        // Handle Search
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchbutton'])) {
            $searchinput = strtolower(mysqli_real_escape_string($con, $_POST['searchbar']));
            $searchinput = preg_replace("/[^a-zA-Z0-9]/", "", $searchinput);

            // Fetch all books from the database without applying Levenshtein
            $searchquery = "SELECT * FROM `book_details_tab` 
                            WHERE (author_name LIKE '%$searchinput%' 
                            OR category LIKE '%$searchinput%' 
                            OR language LIKE '%$searchinput%')
                            AND no_of_copies > 0 
                            ORDER BY book_name ASC";

            // Execute the query
            $result = mysqli_query($con, $searchquery);

            // Array to store matched books based on Levenshtein distance
            $matchedBooks = [];
           // echo $matchedBooks[];
            // Process results in PHP using Levenshtein
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $bookName = strtolower($row['book_name']);
                    $cleanBookName = preg_replace("/[^a-zA-Z0-9]/", "", $bookName); // Clean book name
                    $cleanSearchInput = $searchinput; // Already cleaned search input

                    // Calculate Levenshtein distance
                    $levenshteinDistance = levenshtein($cleanBookName, $cleanSearchInput);

                    // Set a threshold for matching, e.g., distance <= 5
                    if ($levenshteinDistance <= 15) {
                        $matchedBooks[] = $row; // Add to matched books
                        echo $matchedBooks;
                    }
                }

                // Display matched books
                if (!empty($matchedBooks)) {
                    foreach ($matchedBooks as $row) {
                        grid($row['serial_no'], $row['book_name'], $row['book_img'], $row['category'], $row['language'], $mentorname, $studentname, $rollno);
                    }
                } else {
                    echo "<div class='notfound'><p>NO RESULT</p></div>";
                }
            } else {
                echo "<div class='notfound'><p>NO RESULT</p></div>";
            }
        } else {
        ?>
    </div>

    <!-- Mentor Recommendations -->
    <div class="recommendation-container">
        <h4 class="recommendation">Suggestions From Your Mentor</h4>
    </div>

    <div class="gridgallery">
    <?php
            $randomquery = "SELECT * FROM `book_details_tab` WHERE serial_no IN 
                               (SELECT serialno FROM `recommend_tab` 
                                WHERE student_name='$studentname' 
                                AND serialno NOT IN (SELECT serial_no FROM read_tab WHERE readers_name='$studentname'))";
            $randomresult = mysqli_query($con, $randomquery);

            if ($randomresult && mysqli_num_rows($randomresult) > 0) {
                while ($row = mysqli_fetch_array($randomresult)) {
                    grid($row['serial_no'], $row['book_name'], $row['book_img'], $row['category'], $row['language'], $mentorname, $studentname, $rollno);
                }
            } else {
                echo "<div class='notfound'>NO RESULT</div>";
            }
        }
    ?>
    </div>

    <!-- Bootstrap Scripts (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/v+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <!-- JavaScript for handling image upload and AJAX -->
    <script>
        $(document).ready(function() {
            $('#imageupload').change(function() {
                const fileInput = document.getElementById('imageupload');
                const file = fileInput.files[0];

                if (file) {
                    $('#loading').show();
                    const formData = new FormData();
                    formData.append('image', file);

                    $.ajax({
                        url: "img_recong.php", // Change to your PHP file that handles image recognition
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            $('#loading').hide(); // Hide the loading message
                            const recognizedTitle = data.trim();
                            $('#searchinput').val(recognizedTitle);
                        },
                        error: function(xhr, status, error) {
                            $('#loading').hide();
                            alert("Error sending request: " + xhr.responseText);
                        }
                    });
                } else {
                    alert("Please select an image to upload.");
                }
            });
        });
    </script>
</body>

</html>

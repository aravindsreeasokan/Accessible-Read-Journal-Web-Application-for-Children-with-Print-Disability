<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="homestylesheet.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General styles */
        body {
            background-color: #f8f9fa; /* Light background */
            font-family: Arial, sans-serif; /* Set a font */
        }

        /* Welcome section styles */
        #welcome {
            padding: 50px 20px; /* Padding for the welcome section */
            text-align: center; /* Center text */
        }

        .content {
            max-width: 800px; /* Max width for content */
            margin: auto; /* Center content */
        }

        .btn {
            margin-top: 20px; /* Space above the button */
        }

        /* Style for the info icon */
        .info-icon {
            font-size: 1rem; /* Adjust size of the icon */
            color: white; /* Icon color */
        }

        /* Container for the button and note */
        .note-container {
            position: fixed; /* Fixes the container in place */
            bottom: 20px; /* 20px from the bottom */
            right: 10px; /* 20px from the right */
            z-index: 1000; /* Ensures it is above other content */
            display: flex; /* Flex for layout */
            align-items: flex-end; /* Align items to the bottom */
            margin-bottom: 20px; /* Add margin for spacing */
        }

        /* Custom styles for the button */
        .custom-button {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text color */
            border-radius: 50%; /* Make it circular */
            width: 40px; /* Increased width for better clickability */
            height: 40px; /* Increased height */
            display: flex; /* Flex for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            font-size: 1.5rem; /* Adjust font size */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); /* Shadow for depth */
            transition: transform 0.3s, background-color 0.3s; /* Transition for hover effect */
            border: none; /* Remove border */
            margin-left: 15px; /* Space between button and note */
        }

        .custom-button:hover {
            background-color: #0056b3; /* Darken color on hover */
            transform: scale(1.1); /* Scale effect on hover */
        }

        /* Note section styles */
        #noteSection {
            max-height: 0; /* Initially hidden */
            overflow: hidden; /* Prevent overflow */
            margin-right: 15px; /* Space to the right of the note */
            background-color: #ffffff; /* White background for better contrast */
            border: 1px solid #007bff; /* Border to match button color */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow for depth */
            transition: max-height 0.5s ease-out, padding 0.5s ease-out; /* Smooth transition */
            padding: 0; /* Remove initial padding */
            color: #333; /* Text color */
            display: none; /* Completely hide the note section */
        }

        #noteSection.active {
            max-height: 200px; /* Set a max height when active */
            padding: 15px; /* Padding for the note */
            margin-right: 0; /* Reset margin when active */
            display: block; /* Show the note section when active */
        }

        /* Header style for the note */
        #noteSection h5 {
            font-size: 1.2rem; /* Slightly larger font size */
            margin-bottom: 10px; /* Space below the header */
            color: #007bff; /* Header color to match the theme */
        }
    </style>
    <title>Home</title>
</head>
<body>
    <?php 
    include_once 'usernav.php';
    include("connection.php");
    $studentname = $_SESSION['username'];
    $rollno = $_SESSION['roll_no'];
    $disabilityquery = "SELECT * FROM `student_details_tab` WHERE `student_rollno` = $rollno"; // Use backticks
    $result = mysqli_query($con, $disabilityquery);
    $disability = ""; // Initialize the disability variable
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $disability = $row['disability']; // Store the disability value
        }
    }
    ?>

    <section id='welcome'>
        <div class='content'>
            <h1>Welcome to BookBridge</h1>
            <p>Discover a world of adventure, mystery, and fun with our wide selection of books just for you! Whether you love exciting stories, magical tales, or learning new things, we have the perfect book waiting for you. Reading can be an amazing journey, and we're here to help you every step of the way.</p>
            <p>Join our community and start exploring our collection today. You can keep track of the books you want to read, the ones you're reading, and those you've finished. Plus, your mentor can help you find the best books and ask you fun questions about your reading adventures.</p>
            <a href='rent_a_book.php' class='btn btn-primary'>Start Your Adventure Now</a>
        </div>
    </section>

    <!-- Container for the button and note -->
    <div class="note-container">
        <!-- Expanding Note Section -->
        <div id="noteSection">
            <h5>Tips</h5>
            <p>Please wait for suggestions and tips</p>
        </div>

        <!-- Button that toggles the note section -->
        <button class="custom-button" id="toggleNoteButton">
            <i class="bi bi-info-circle info-icon"></i>
        </button>
    </div>

    <input type="hidden" id="disability" value="<?php echo $disability; ?>"> <!-- Correctly output disability -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fixing the class reference for the button
            $('#toggleNoteButton').click(function(event) {
                event.preventDefault();
                var disability = $('#disability').val(); // Correctly get the disability value

                // Toggle the note section
                $('#noteSection').toggleClass('active');

                // Making the AJAX request to tips.php
                $.ajax({
                    url: "tips.php",
                    type: "POST",
                    data: { disability: disability }, // Send disability value
                    success: function(data) {
                        // Dynamically insert the response into the note section
                        $('#noteSection h5').text("Helpful Tip");
                        $('#noteSection p').text(data); // Assuming the response is plain text
                    },
                    error: function(xhr, status, error) {
                        alert("Error sending request: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>

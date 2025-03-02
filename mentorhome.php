<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="homestylesheet.css" rel="stylesheet" />
    <!-- Bootstrap CSS for List Group Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Home</title>

    <style>
        body {
            background-color: #f4f4f4; /* Light background color */
            font-family: Arial, sans-serif; /* Font family */
            margin: 0; /* Remove default margins */
            height: 100vh; /* Full height of the viewport */
            display: flex;
            flex-direction: column; /* Column layout */
        }

        /* Combined section styles */
        .combined-section {
            display: flex; /* Flexbox layout */
            justify-content: space-between; /* Space between the two sections */
            padding: 40px; /* Padding for the section */
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px; /* Margin for spacing */
            flex-grow: 1; /* Allow the section to grow and fill available space */
        }

        /* Left side (welcome section) styles */
        .welcome-content {
            flex: 1; /* Take available space */
            padding: 20px; /* Padding for the content */
            text-align: center; /* Center text */
        }

        .welcome-content h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px; /* Space below the heading */
        }

        .welcome-content p {
            color: #555;
            margin-bottom: 15px;
        }

        .welcome-content .btn {
            background-color: #007bff; /* Button background */
            color: #ffffff; /* Button text color */
            padding: 10px 20px; /* Button padding */
            border-radius: 5px; /* Rounded corners for the button */
            text-decoration: none; /* No underline for the button */
            margin-top: 20px; /* Space above the button */
        }

        .welcome-content .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Mentor Links Styles */
        .mentor-links {
            width: 250px; /* Fixed width for mentor links */
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.1); /* Slightly transparent white background */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px); /* Glassy effect */
            border: 1px solid rgba(255, 255, 255, 0.5); /* Glassy border */
            margin-left: 20px; /* Space to the left */
            color: #fff; /* Text color */
        }

        .mentor-links h2 {
            margin-bottom: 20px;
            font-size: 20px; /* Increased font size for the heading */
            color: grey; /* White text for heading */
            font-weight: 600; /* Bold font weight for heading */
            text-align: center; /* Center heading */
        }

        .mentor-links .list-group-item {
            font-size: 16px;
            color: #ffffff; /* White text color */
            cursor: pointer;
            padding: 10px 15px;
            border: none;
            transition: background-color 0.3s ease;
            border-radius: 5px; /* Rounded corners for list items */
        }

        .mentor-links .list-group-item:hover {
            background-color: rgba(0, 56, 117, 0.6); /* Darker transparent blue on hover */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .combined-section {
                flex-direction: column; /* Stack items vertically on small screens */
                align-items: center; /* Center items */
            }

            .mentor-links {
                margin-left: 0; /* Remove margin on small screens */
                width: 100%; /* Full width */
            }
        }
    </style>
</head>

<body>

    <!-- Include navigation -->
    <?php include_once 'nav.php'; ?>

    <div class="combined-section">
        <!-- Welcome Section -->
        <div class="welcome-content">
            <h1>Welcome to BookBridge</h1>
            <p>As a mentor, you play a crucial role in helping children with disabilities discover the joy of reading. Our platform offers a wide range of books specially curated to support diverse learning needs and preferences. From engaging stories to educational materials, we have resources to make reading an enriching experience for every child.</p>
            <p>Join our community and start recommending books that will inspire, educate, and entertain. With our constantly updated collection, you'll always find the right book to help children develop a love for reading.</p>
            <a href='your_student.php' class='btn'>Start Recommending Now</a>
        </div>

        <!-- Mentor Links Section with Bootstrap List Group -->
        <div class="mentor-links">
            <h2>Mentor Actions</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="your_recommendation.php" class="text-decoration-none">Your Recommendation</a>
                </li>
                <li class="list-group-item">
                    <a href="result_of_student.php" class="text-decoration-none">Student Result</a>
                </li>
                <li class="list-group-item">
                    <a href="student_choose.php" class="text-decoration-none">Choose Your Student</a>
                </li>
                <li class="list-group-item">
                    <a href="exam_question.php" class="text-decoration-none">Set Question</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS for any future components (optional) -->
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    -->
</body>

</html>

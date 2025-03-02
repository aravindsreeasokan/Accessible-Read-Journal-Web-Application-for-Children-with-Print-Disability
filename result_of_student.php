<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <title>Student Exam Results</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        table {
            margin-top: 20px;
            border-collapse: collapse;
        }
        th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        td {
            text-align: center;
            vertical-align: middle;
        }
        tr:nth-child(even) {
            background-color: #e9ecef;
        }
        tr:hover {
            background-color: #cce5ff;
        }
        .table-bordered {
            border: 2px solid #007bff;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #007bff;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include("nav.php");  // Include the navigation bar
    include("connection.php"); // Include the database connection

    // Escape the session variable to prevent SQL injection
    $mentor_name = mysqli_real_escape_string($con, $_SESSION['username']);
      //  echo $mentor_name;
    // Updated SQL query to fetch exam results and corresponding book names
    $sql = "
    SELECT em.book_id, bd.book_name, em.student_name, em.obtained_mark, em.total_mark
    FROM exam_mark_tab em
    JOIN book_details_tab bd ON em.book_id = bd.serial_no  -- Match book_id with serial_no
    JOIN mentor_student_tab ms ON em.student_id = ms.student_rollno  -- Match student_id with student_rollno
    WHERE ms.mentor_name = '$mentor_name'
";


    // Execute the query
    $result = mysqli_query($con, $sql);
    ?>
    
    <div class="container">
        <h2 class="text-center">Student Exam Results</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Book ID</th>
                    <th>Book Name</th> <!-- Added a column for Book Name -->
                    <th>Score</th>
                    <th>Total Marks</th>
                    <th>Action</th> <!-- Added an Action column for the chat button -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the results and display in table rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['student_name']) . "</td>
                                <td>" . htmlspecialchars($row['book_id']) . "</td>
                                <td>" . htmlspecialchars($row['book_name']) . "</td> <!-- Displaying Book Name -->
                                <td>" . htmlspecialchars($row['obtained_mark']) . "</td>
                                <td>" . htmlspecialchars($row['total_mark']) . "</td>
                                <td>
                                    <form method='GET' action='chat.php'>
                                        <input type='hidden' name='bookname' value='" . htmlspecialchars($row['book_name']) . "'>
                                        <input type='hidden' name='readers_name' value='" . htmlspecialchars($row['student_name']) . "'>
                                        <input type='submit' value='Chat' class='btn btn-primary'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No results found for your students.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Scripts (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--<script src="js/bootstrap.js"></script>-->
</body>
</html>

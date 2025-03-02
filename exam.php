<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="styles.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Exam</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <?php
    session_start();
    include('usernav.php');
    include("connection.php");
    $q_id = $_POST['q_id'];
    $serialno= $_POST['serialno'];
    $studentname = $_SESSION['username'];
    $query = "SELECT * FROM questions_tab WHERE id='$q_id' ORDER BY id ASC LIMIT 1";
    $result = mysqli_query($con, $query);
    ?>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-center">Answer This Question</h4>
                <form id="examForm">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="mb-4">
                            <p class="lead"><strong>Question:</strong> <?php echo $row['question_text']; ?></p>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="opt" value="1" id="option_1">
                                <label class="form-check-label" for="option_1"><?php echo $row['option_1']; ?></label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="opt" value="2" id="option_2">
                                <label class="form-check-label" for="option_2"><?php echo $row['option_2']; ?></label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="opt" value="3" id="option_3">
                                <label class="form-check-label" for="option_3"><?php echo $row['option_3']; ?></label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="opt" value="4" id="option_4">
                                <label class="form-check-label" for="option_4"><?php echo $row['option_4']; ?></label>
                            </div>
                            <input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
                        </div>
                    <?php endwhile; ?>
                    <div class="d-flex justify-content-end">
                        <button type="button" id="sub" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {
    $('#sub').click(function(event) {
        var selectedOption = $('input[name="opt"]:checked').val();
        var questionId = $('input[name="q_id"]').val();

        if (selectedOption) {
            $.ajax({
                url: "submit_exam.php",
                type: "POST",
                data: {
                    q_id: questionId,
                    selected_option: selectedOption
                },
                success: function(response) {
                    window.location.href = 'question_table.php'; 
                },
                error: function(xhr, status, error) {
                    alert("Error sending request: " + xhr.responseText);
                }
            });
        } else {
            alert("Please select an option.");
        }
    });
});
</script>
</html>

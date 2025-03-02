<?php 
    ob_start();
    session_start();
    require_once('C:/wamp64/www/Project/mini - Copy/TCPDF-main/TCPDF-main/tcpdf.php'); // Include TCPDF Library
    include ('usernav.php');
    include("connection.php");

    if (isset($_POST['serialno']) && !empty($_POST['serialno'])) {
        $serialno = $_POST['serialno'];
        $_SESSION['serialno'] = $serialno;
        $bok_s_no=$serialno;
    }

    $s_no = $_SESSION['serialno'];
    $studentname = $_SESSION['username'];
    $student_id = $_SESSION['roll_no'];
    $mentorname = $_SESSION['mentor'];

    $book_query = "SELECT book_name FROM book_details_tab WHERE serial_no='$s_no'";
        $book_result = mysqli_query($con, $book_query);
        $book_row = mysqli_fetch_assoc($book_result);
        $book_name = $book_row['book_name'];
        $bok_name=$book_name;
        //echo $book_name;
    $attempt_check_query = "SELECT * FROM attended_exam WHERE book_id = '$s_no' AND student_id = '$student_id' AND Number_of_attempt >= 1";
    $attempt_check_result = mysqli_query($con, $attempt_check_query);
    $already_attempted = mysqli_num_rows($attempt_check_result) > 0;

    $query = "SELECT * FROM questions_tab WHERE serialno='$s_no' ORDER BY id ASC";
    $result = mysqli_query($con, $query);
    $totmark = mysqli_num_rows($result);

    function generateCertificate($studentname, $obtained_mark, $total_mark,$book_name,$mentorname) {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Certificate of Participation');
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    
    // Set Colors
    $green = array(0, 102, 102);
    $darkText = array(51, 51, 51);
    
    // Header Text
    $pdf->SetFont('Helvetica', 'B', 20);
    $pdf->SetTextColor($green[0], $green[1], $green[2]);
    $pdf->Cell(0, 15, "CERTIFICATE", 0, 1, 'C');
    $pdf->SetFont('Helvetica', '', 14);
    $pdf->Cell(0, 10, "OF PARTICIPATION", 0, 1, 'C');
    
    // Add a Line
    $pdf->Ln(8);
    $pdf->SetTextColor($darkText[0], $darkText[1], $darkText[2]);
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(0, 10, "THIS IS PRESENTED TO:", 0, 1, 'C');
    
    // Student Name
    $pdf->SetFont('Helvetica', 'B', 28);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 15, $studentname, 0, 1, 'C');
    
    // Book Name
    $pdf->SetFont('Helvetica', 'I', 14);
    $pdf->Cell(0, 10, "For participating in \"$book_name\"", 0, 1, 'C');
    
    // Footer Text
    $pdf->Ln(15);
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(0, 10, "Mentor: $mentorname", 0, 1, 'L');
    $pdf->Cell(0, 10, "Date: " . date('d-m-Y'), 0, 1, 'R');
    
    // Signature Placeholder
    $pdf->Ln(15);
    $pdf->SetFont('Helvetica', 'I', 12);
    $pdf->Cell(0, 10, "________________________", 0, 1, 'R');
    $pdf->Cell(0, 5, "Signature", 0, 1, 'R');
    
    // Clear any previous output
    ob_end_clean();
    
    // Output PDF
    $pdf->Output('certificate_participation.pdf', 'D');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Exam</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <?php if ($already_attempted): ?>
                    <h2 class="card-title text-center">Exam Result</h2>
                    <div class="alert alert-warning text-center">
                        <?php
                            $mark = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $question_id = $row['id'];
                                $selected_answer_query = "SELECT selected_option FROM student_answers_tab WHERE student_id='$student_id' AND question_id='$question_id'";
                                $answer_result = mysqli_query($con, $selected_answer_query);
                                $selected_answer_row = mysqli_fetch_assoc($answer_result);
                                $selected_answer = $selected_answer_row['selected_option'];

                                $correct_answer_query = "SELECT correct_option FROM questions_tab WHERE id='$question_id'";
                                $correct_answer_result = mysqli_query($con, $correct_answer_query);
                                $correct_answer_row = mysqli_fetch_assoc($correct_answer_result);
                                $correct_answer = $correct_answer_row['correct_option'];
                                $bok_name=$book_name;

                                if ($selected_answer == $correct_answer) {
                                    $mark += 1;
                                }
                            }
                            echo $book_name;
                            echo "Total Mark: $mark out of $totmark";
                        ?>
                    </div>
                    <form method="POST">
                        <button type="submit" name="generate_certificate" class="btn btn-success">Download Certificate </button>
                        
                    </form>
                    <?php if (isset($_POST['generate_certificate'])) {
                         echo "<script>alert('$book_name');</script>"; 
                         generateCertificate($studentname, $mark, $totmark, $book_name, $mentorname);
                         exit();
                    } ?>
                <?php else: ?>
                    <h2 class="card-title text-center">Select a Question</h2>
                    <?php if ($totmark > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['question_text']; ?></td>
                                        <td>
                                            <?php 
                                            $question_id = $row['id'];
                                            $check_answer_query = "SELECT * FROM student_answers_tab WHERE student_id='$student_id' AND question_id='$question_id'";
                                            $answer_result = mysqli_query($con, $check_answer_query);
                                            if (mysqli_num_rows($answer_result) > 0) {
                                                echo "<span class='text-success'>Answered</span>";
                                            } else {
                                                echo "<span class='text-danger'>Not Answered</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form method="POST" action="exam.php">
                                                <input type="hidden" name="q_id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="serialno" value="<?php echo $s_no; ?>">
                                                <button type="submit" class="btn btn-primary">Answer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <button type="button" id="submitAnswers" class="btn btn-success">Submit Answer</button>
                    <?php else: ?>
                        <div class="alert alert-info text-center">No questions available for this exam.</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#submitAnswers').click(function() {
            var serialno = '<?php echo $s_no; ?>';
            $.ajax({
                url: "exam_attendence.php",
                type: "POST",
                data: { serialno: serialno },
                success: function(data) {
                    alert(data);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
    });
    </script>
</body>
</html>
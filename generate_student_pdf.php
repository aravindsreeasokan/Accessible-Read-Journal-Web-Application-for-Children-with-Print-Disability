<?php
require_once('C:/wamp64/www/Project/mini - Copy/TCPDF-main/TCPDF-main/tcpdf.php'); // Include TCPDF library
include("connection.php");

$rollno = isset($_GET['roll_no']) ? $_GET['roll_no'] : '';

if (!$rollno) {
    die("No student found.");
}

$query = "SELECT * FROM `student_details_tab` WHERE student_rollno='$rollno'";
$result = mysqli_query($con, $query);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found.");
}

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Project');
$pdf->SetTitle('Student Details');
$pdf->SetSubject('Student Details PDF');

// Set default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Get the current date
$date = date("F j, Y, g:i a");

// Custom header
$htmlHeader = '
<div style="text-align:center;">
    <h1 style="font-size: 24px; color: #4CAF50;">BookBridge</h1>
    <p style="font-size: 12px;">Downloaded on: ' . $date . '</p>
    <hr style="border: 1px solid #4CAF50;"/>
</div>';

// Output the custom header
$pdf->writeHTML($htmlHeader, true, false, true, false, '');

// Student details content
$html = '
<h2 style="color: #333;">Student Details</h2>
<table border="1" cellspacing="3" cellpadding="4">
    <tr>
        <th style="background-color: #f2f2f2;">Roll Number:</th>
        <td>' . $student['student_rollno'] . '</td>
    </tr>
    <tr>
        <th style="background-color: #f2f2f2;">Name:</th>
        <td>' . $student['student_name'] . '</td>
    </tr>
    <tr>
        <th style="background-color: #f2f2f2;">Age:</th>
        <td>' . $student['age'] . '</td>
    </tr>
    <tr>
        <th style="background-color: #f2f2f2;">Location:</th>
        <td>' . $student['location'] . '</td>
    </tr>
    <tr>
        <th style="background-color: #f2f2f2;">Disability:</th>
        <td>' . $student['disability'] . '</td>
    </tr>
</table>';

// Output the student details
$pdf->writeHTML($html, true, false, true, false, '');

// Footer with page number
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages(), 0, 0, 'C');

// Close and output PDF document
$pdf->Output('student_details_' . $student['student_rollno'] . '.pdf', 'D'); // Force download
?>

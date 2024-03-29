<?php
session_start();
require('../../fpdf186/fpdf.php');

// Extract data
$courseName = $_POST["course"];
$studentID = $_POST["studentid"];
$rollNo = $_POST["rollno"];
$studentName = $_POST["name"];
$courseID = $_POST["courseid"];
$marksData = json_decode($_POST["marks"], true);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

$totalWidth = $pdf->GetPageWidth() - 20; // Total width available for the table
$subjectWidth = $totalWidth * 0.6; // 60% for subject
$marksWidth = $totalWidth * 0.4; // 40% for marks

$pdf->Cell(0, 50, '', 0, 1, 'C');
// Add college title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'K K Wagh Arts, Commerce, Science and Computer Science College', 0, 1, 'C');

// Add logo
$pdf->Image('../../STYLE/Images/kkw-logo.png', $pdf->GetX() + ($pdf->GetPageWidth() / 2) - 60, $pdf->GetY() - 65, 100);

// Add student information
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($subjectWidth, 10, 'Course: ' . $courseName, 0, 1);
$pdf->Cell($subjectWidth, 10, 'Student ID: ' . $studentID, 0, 0);
$pdf->Cell($marksWidth, 10, 'Rollno: ' . $rollNo, 0, 1);
$pdf->Cell($subjectWidth, 10, 'Name: ' . $studentName, 0, 0);
$pdf->Cell($marksWidth, 10, 'Course ID: ' . $courseID, 0, 1);

// Add marks table
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($subjectWidth - 20, 15, 'SUBJECT', 1, 0, 'C');
$pdf->Cell($marksWidth + 20, 15, 'MARKS', 1, 1, 'C');

foreach ($marksData as $subject => $marks) {
    $pdf->Cell($subjectWidth - 20, 10, $subject, 1, 0);
    $pdf->Cell($marksWidth + 20, 10, $marks, 1, 1, 'C');
}

// Calculate result
$failed = min($marksData) < 35;
$result = $failed ? "Result: Failed" : "Result: Passed";

// Add result to the PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($subjectWidth + 70, 20, $result, 0, 1, 'C');

// Output the PDF
$pdf->Output();
?>

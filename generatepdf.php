<?php
require('fpdf/fpdf.php');

// Retrieve the content from the AJAX request
//$bookOutlineContent = $_POST['bookOutlineContent'];
$chapterContents = [];

// Iterate through the chapter contents
foreach ($_POST as $key => $value) {
  if (strpos($key, 'chapterContent_') === 0) {
    $chapterContents[] = $value;
  }
}

// Create a new FPDF instance
$pdf = new FPDF();

// Add the book outline content
// $pdf->AddPage();
// $pdf->SetFont('Arial', '', 12);
// $pdf->MultiCell(0, 10, $bookOutlineContent);

// Add the chapter contents
foreach ($chapterContents as $chapterContent) {
  $pdf->AddPage();
  $pdf->SetFont('Arial', '', 12);
  $pdf->MultiCell(0, 10, $chapterContent);
}

// Output the PDF as a download
$pdf->Output('PagePilotEbook.pdf', 'D');


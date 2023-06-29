<?php

require_once 'vendor/autoload.php'; // Include the PHPWord autoloader

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;

// Retrieve the book outline content from the form data
$bookOutlineContent = $_POST['bookOutlineContent'];

// Retrieve the chapter contents from the form data
$chapterContents = [];
foreach ($_POST as $key => $value) {
    if (strpos($key, 'chapterContent_') === 0) {
        $chapterContents[] = $value;
    }
}

// Create a new PHPWord object
$phpWord = new PhpWord();

// Add the book outline content
$phpWord->addParagraphStyle('bookOutlineStyle', array('spaceBefore' => Converter::pointToTwip(12)));
$section = $phpWord->addSection();
$section->addText($bookOutlineContent, ['name' => 'Arial', 'size' => 12, 'spaceBefore' => 240], 'bookOutlineStyle');

// Add each chapter content
foreach ($chapterContents as $index => $chapterContent) {
    $chapterTitle = 'Chapter ' . ($index + 1);
    $section->addText($chapterTitle, ['name' => 'Arial', 'size' => 14, 'bold' => true, 'underline' => 'single']);

    $section->addTextBreak();
    $section->addText($chapterContent, ['name' => 'Arial', 'size' => 12]);

    $section->addPageBreak();
}

// Set the appropriate headers to provide the Word Doc file for download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="document.docx"');

// Save the Word Doc file to the output stream (php://output)
$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');

exit;


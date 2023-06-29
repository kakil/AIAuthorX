<?php

require_once 'vendor/autoload.php'; // Make sure to include the necessary Google API client library

// Set up Google API client
$client = new Google_Client();
$client->setApplicationName('Your Application Name');
$client->setScopes([Google_Service_Drive::DRIVE_FILE]);
$client->setAuthConfig('path/to/your/client_credentials.json'); // Replace with the path to your client credentials JSON file

// Create a new Google Doc file
$service = new Google_Service_Drive($client);
$fileMetadata = new Google_Service_Drive_DriveFile([
    'name' => 'My Generated Google Doc', // Replace with the desired name for your Google Doc
    'mimeType' => 'application/vnd.google-apps.document'
]);
$file = $service->files->create($fileMetadata, ['fields' => 'id']);

// Retrieve the chapter content from the form data
$bookOutlineContent = $_POST['bookOutlineContent'];
$chapterContents = [];
foreach ($_POST as $key => $value) {
    if (strpos($key, 'chapterContent_') === 0) {
        $chapterContents[] = $value;
    }
}

// Build the content of the Google Doc
$content = $bookOutlineContent . PHP_EOL; // Add the book outline content

foreach ($chapterContents as $index => $chapterContent) {
    $content .= 'Chapter ' . ($index + 1) . ': ' . PHP_EOL;
    $content .= $chapterContent . PHP_EOL;
}

// Insert the content into the Google Doc file
$driveService = new Google_Service_Drive($client);
$contentStream = fopen('php://temp', 'r+');
fwrite($contentStream, $content);
rewind($contentStream);
$result = $driveService->files->update($file->getId(), $contentStream, [
    'mimeType' => 'text/plain'
]);

// Redirect to the generated Google Doc
if ($result) {
    $url = 'https://docs.google.com/document/d/' . $file->getId();
    header('Location: ' . $url);
    exit;
} else {
    echo 'Error generating the Google Doc.';
}

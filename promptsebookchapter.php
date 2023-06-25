<?php

header('Access-Control-Allow-Origin: same-origin');
session_start();
require_once("user/protect.php");
require_once("config.php");

if ($masterkeymode==true){
	$apikey=$masterapikey;
} else {
	$apikey=$_SESSION["user"]["user_apikey"];
	//Print($apikey);
}


// Retrieve the Book Topic value from the user input
$ebookTopic = $_POST['ebookTopic'];
$chapter = $_POST['chapter'];
$bookOutline = $_POST['bookOutlineText'];


//print "Book Topic1: " . $bookTopic;


// Check if the request is from the chapter button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chapter'])) {

	
	// Function to interact with the OpenAI API and retrieve the response
	function getAIResponse($message, $bookOutline) {
		global $apikey;
		//print('  API Key  ' . $apikey . ' ... ');
	
		$data = array(
			'model' => 'gpt-3.5-turbo',
			'messages' => array(
				array('role' => 'system', 'content' => 'You are an expert digital marketer and copywriter'),
				array('role' => 'user', 'content' => $message),
				array('role' => 'assistant', 'content' => $bookOutline),
				array('role' => 'system', 'content' => 'Please generate the content with the specified HTML tags. Do not use Markup.  Use HTML only. Do not provide any content to prefix the chapter. No additonal comments.')
			)
		);

		//echo 'Data for API Message: ' . $data[0]['messages'][1]['content'];
		//echo 'Data for API Message: ' . $message;
	
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer ' . $apikey
			)
		));
	
		$response = curl_exec($curl);
		curl_close($curl);
	
		if ($response !== false) {
			$responseData = json_decode($response, true);
			//print "  **** Response: " . $response . " *******";
			return $responseData['choices'][0]['message']['content'];
		}
		
		return '';
	}
	

	// Generate the book chapters using the OpenAI API
	$bookChapterMessage = "Write Chapter ". $chapter . " from the outline.  The content should be formatted in SEO-friendly HTML, limited to the following HTML tags: p, h1, h2, h3, h4, h5, h6, strong, li, ol, i, br.";
	//echo ($bookOutlineMessage);
	$bookChapter = getAIResponse($bookChapterMessage, $bookOutline);

	// Display the book titles and book outline
	echo json_encode(array('bookChapter' => $bookChapter));
}
?>
	

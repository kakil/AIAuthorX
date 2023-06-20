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
$bookTopic = $_POST['bookTopic'];
//print "Book Topic1: " . $bookTopic;


// Check if the request is from the submit button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookTopic'])) {

	

	// Generate the book titles and book outline using the OpenAI API
	$bookTopic = $_POST['bookTopic'];

	// Function to interact with the OpenAI API and retrieve the response
	function getAIResponse($message) {
		global $apikey;
		//print('  API Key  ' . $apikey . ' ... ');
	
		$data = array(
			'model' => 'gpt-3.5-turbo',
			'messages' => array(
				array('role' => 'system', 'content' => 'You are an expert digital marketer and copywriter'),
				array('role' => 'user', 'content' => $message),
				array('role' => 'system', 'content' => 'Please generate the content with the specified HTML tags. Do not use Markup.  Use HTML only.')
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
	

	// Generate the book titles and book outline using the OpenAI API
	$bookOutlineMessage = "Write an ebook outline about the following topic: " . $bookTopic. ".  The ebook should have 10 sections. The content should be formatted in SEO-friendly HTML, limited to the following HTML tags: p, h1, h2, h3, h4, h5, h6, strong, li, ol, i, br.";
	//echo ($bookOutlineMessage);
	$bookOutline = getAIResponse($bookOutlineMessage);
	
	

	// Display the book titles and book outline
	echo json_encode(array('bookOutline' => $bookOutline));
}
?>
	

<?php

require ("phpMQTT.php");

$access_token = 'mzh7DDNB8Ui5/Q0UcWIXO0op83Wi+tkP4LQWscYDxDfPRazOeqCPcG6adySX+3TTO1KfonOcewrB4x2ipuEp9RGyA4nl2pV+9KIkoWZNA6exPh5QXtH3ht+XOwgBgnThw7a2T4P8P9tuivAw9vUP1gdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			
			$mqtt = new phpMQTT("km1.io", 1883, "phpMQTT Pub Example"); //Change client name to something unique
			if ($mqtt->connect(true,NULL, $username = 'anakkapon', $password = 'ubgawoik')) {
				$mqtt->publish("/anakkapon/rm2",$text,0);
				$mqtt->close();
			}
			
		

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";

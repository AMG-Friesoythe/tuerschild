<?php
$url = 'https://nessa.webuntis.com/WebUntis/jsonrpc.do?school=AMG+Friesoythe';


$sessionid = file_get_contents('http://10.0.133.42/api/getSessionID.php');
$roomid = $_GET['room'];

$data = array('id' => 'yeet', 'method' => 'getTimetable', 'params' => array('type' => '4', 'id' => $roomid), 'jsonrpc' => '2.0'); 
$options = array(
	'http' => array(
		'method'  => 'POST',
		'header'  => "Content-type: application/json\r\nCookie: JSESSIONID=" . $sessionid,
		'content' => json_encode($data)
	)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { echo 'error lol'; }

$response = json_decode( $result );
$timetable = $response->result;

?>

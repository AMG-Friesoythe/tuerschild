<?php
error_reporting(E_ALL);
include("creds.php");

$url = 'https://nessa.webuntis.com/WebUntis/jsonrpc.do?school='.$WU_SCHOOL;
$data = array('id' => 'yeet', 'method' => 'authenticate', 'params' => array('user' => $WU_USER, 'password' => $WU_PASSWORD, 'client'=> 'WebUntisTest'), 'jsonrpc' => '2.0'); 

$options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => "Content-type: application/json\r\n",
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { echo 'error lol'; }

$response = json_decode( $result );
$sessionid =  $response->result->sessionId;

echo $sessionid;


?>





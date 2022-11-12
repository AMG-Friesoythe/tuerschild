<?php
include("help.php");
$url = 'https://nessa.webuntis.com/WebUntis/jsonrpc.do?school=AMG+Friesoythe';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$sessionid = file_get_contents('http://10.0.133.42/api/getSessionID.php');
$roomid = $_GET['id'];

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

$file = fopen("/var/www/html/api/raumliste.json", "r");
$roomlist = fread($file, filesize("/var/www/html/api/raumliste.json"));
fclose($file);
$roomlist = json_decode($roomlist);

$finalObject = (object)array("timetable" => array());
$roomResolved = resolveRoom($roomid)->name;
$finalObject->room_no = $roomResolved;

$finalObject->room_z1 = "";
$finalObject->room_z2 = "";
foreach($roomlist as $key => $value) {
	if ($value->R == $roomResolved) {
		$finalObject->room_z1 = $value->z1;
		$finalObject->room_z2 = $value->z2;
		break;
	}
}


$response = json_decode( $result );
foreach($response->result as $i => $hour) {
	if (isset($hour->code)) {
		if($hour->code == "cancelled") {
			continue;
		}
	}
	$teacher = resolveTeacher((string)$hour->te[0]->id);
	$subject = resolveSubject((string)$hour->su[0]->id);
	if ($hour->startTime == 800) {
		array_push($finalObject->timetable, (object)array("hour" => 1, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 850) {
		array_push($finalObject->timetable, (object)array("hour" => 2, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 955) {
		array_push($finalObject->timetable, (object)array("hour" => 3, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1045) {
		array_push($finalObject->timetable, (object)array("hour" => 4, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1145) {
		array_push($finalObject->timetable, (object)array("hour" => 5, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1235) {
		array_push($finalObject->timetable, (object)array("hour" => 6, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1355) {
		array_push($finalObject->timetable, (object)array("hour" => 7, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1445) {
		array_push($finalObject->timetable, (object)array("hour" => 8, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1530) {
		array_push($finalObject->timetable, (object)array("hour" => 9, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	if ($hour->startTime == 1615) {
		array_push($finalObject->timetable, (object)array("hour" => 10, "teacher" => $teacher->name, "subj" => $subject->name));
	}	
	//var_dump($hour);
	//echo("<br>");
}

echo(json_encode($finalObject,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>

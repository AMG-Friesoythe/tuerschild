<?php
include("help.php");
$url = 'https://nessa.webuntis.com/WebUntis/jsonrpc.do?school=AMG+Friesoythe';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$sessionid = file_get_contents('http://10.0.133.42/api/getSessionID.php');
$roomid = $_GET['id'];

//$data = array('id' => 'yeet', 'method' => 'getTimetable', 'params' => array('startDate' => '20220713', 'endDate' => '20220713', 'type' => '4', 'id' => $roomid), 'jsonrpc' => '2.0'); 
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

$roomResolved = resolveRoom($roomid)->name;
$finalObject = (object)array("room_no" => $roomResolved);

date_default_timezone_set("Europe/Berlin");
$finalObject->time = (object)array("hour" => date("H"), "minute" => date("i"), "day" => date("w"));
//$finalObject->time = (object)array("hour" => 8, "minute" => 00, "day" => 5);

$finalObject->room_z1 = "";
$finalObject->room_z2 = "";
foreach($roomlist as $key => $value) {
	if ($value->R == $roomResolved) {
		$finalObject->room_z1 = $value->z1;
		$finalObject->room_z2 = $value->z2;
		break;
	}
}

$currentHour = -1;

/*
if((int) date("H") >= 8 && (int) date("H") <= 17) {
	$timestamp = (int) date("H").date("i");
	if($timestamp >= 800 && $timestamp < 845) {
		$currentHour = 1;
	}
	if($timestamp >= 845 && $timestamp < 935) {
		$currentHour = 2;
	}
	if($timestamp >= 935 && $timestamp < 1040) {
		$currentHour = 3;
	}
	if($timestamp >= 1040 && $timestamp < 1130) {
		$currentHour = 4;
	}
	if($timestamp >= 1130 && $timestamp < 1230) {
		$currentHour = 5;
	}
	if($timestamp >= 1230 && $timestamp < 1320) {
		$currentHour = 6;
	}
	if($timestamp >= 1320 && $timestamp < 1440) {
		$currentHour = 7;
	}
	if($timestamp >= 1440 && $timestamp < 1530) {
		$currentHour = 8;
	}
	if($timestamp >= 1530 && $timestamp < 1615) {
		$currentHour = 9;
	}
	if($timestamp >= 1615 && $timestamp < 1700) {
		$currentHour = 10;
	}
}
 */

$currentHour = getHour((int) date("H").date("i"));
//$currentHour = 1;
if ($currentHour == -1) {
	$currentHour = 1;
} 

$finalObject->current_period = $currentHour;

$finalObject->timetable_z1= "-";
$finalObject->timetable_z2= "-";
$finalObject->timetable_z3= "-";
$finalObject->timetable_z4= "-";

$response = json_decode( $result );


if (isset($response->result)) {
foreach($response->result as $i => $hour) {
	if (isset($hour->code)) {
		if($hour->code == "cancelled") {
			continue;
		}
	}
	if (empty($hour->te)) {
		$teacher = (object)array('name' => "---");
	} else {
		$teacher = resolveTeacher((string)$hour->te[0]->id);
	}
	if (empty($hour->su)) {
		$subject = (object)array('name' => "---");
	} else {
		$subject = resolveSubject((string)$hour->su[0]->id);
	}
	$hourDifference = getHour($hour->startTime) - $currentHour;

	if ($hourDifference >= 0 && $hourDifference <= 3) {
		if ($hourDifference == 0) {
			$finalObject->timetable_z1 = $teacher->name.", ".$subject->name;
		} elseIf ($hourDifference == 1) {
			$finalObject->timetable_z2 = $teacher->name.", ".$subject->name;
		} elseIf ($hourDifference == 2) {
			$finalObject->timetable_z3 = $teacher->name.", ".$subject->name;
		} elseIf ($hourDifference == 3) {
			$finalObject->timetable_z4 = $teacher->name.", ".$subject->name;
		}
	}
	/*
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
	 */
}
}

echo(json_encode($finalObject,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>

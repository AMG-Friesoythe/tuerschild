<?php

include("config.php");

function resolveTeacher($teacherid)
{


	$teacherlist = file_get_contents('http://'.$GLOBALS['BASE_URL'].'/getTeachers.php');

	$teachers = json_decode( $teacherlist );

	foreach($teachers->result as $i => $teacher) {
		if ($teacher -> id == $teacherid) {
		
			return $teacher;
		}
	}

	
}

function resolveSubject($subjectid)
{


	$subjectlist = file_get_contents('http://'.$GLOBALS['BASE_URL'].'/getSubjects.php');

	$subjects = json_decode( $subjectlist );

	foreach($subjects->result as $i => $subject) {
		if ($subject -> id == $subjectid) {
			return $subject;

		}
	}
}

function resolveRoom($roomid)
{

	$roomslist = file_get_contents("http://".$GLOBALS['BASE_URL']."/getRooms.php");

	$rooms = json_decode( $roomslist );

	foreach($rooms as $i => $room) {
		if ($room -> id == $roomid) {
			return $room;
		}
	}
}

function getHour($timestamp) {
	$currentHour = -1;
	if($timestamp >= 800 && $timestamp <= 1700) {
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
	return $currentHour;
}
	
?>

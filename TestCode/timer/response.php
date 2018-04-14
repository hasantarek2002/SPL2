<?php
	session_start();
	date_default_timezone_set("Asia/Dhaka");
	$fromTime=date('Y-m-d H:i:s');
	$toTime=$_SESSION['endTime'];
	//echo date('Y-m-d H:i:s').'<br>';

	$timeFirst=strtotime($fromTime);
	//echo (date("Y-m-d H:i:s",$timeFirst)) .'<br>';
	$timeSecond=strtotime($toTime);
	//echo (date("Y-m-d H:i:s",$timeSecond)) .'<br>';

	$difference=$timeSecond-$timeFirst;

	echo gmdate("H:i:s",$difference);

?>
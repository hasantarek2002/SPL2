<?php
//add datetime with duration with regex
$initialTime='2011-11-17 20:30:00';
echo "Initial date is ".$initialTime.'<br>';
$duration = "09:00:00";
echo "duration date is ".$duration.'<br>';

$splitDate = explode(":",$duration);
$hour_to_add = $splitDate[0];
$minutes_to_add = $splitDate[1];
$second_to_add = $splitDate[2];

echo "hour is ".$splitDate[0].'<br>';
echo "minuite  is ".$splitDate[1].'<br>';
echo "second is ".$splitDate[2].'<br>';






$time = new DateTime($initialTime);
$time->add(new DateInterval('PT' . $hour_to_add . 'H'.$minutes_to_add.'M'.$second_to_add.'S'));
$stamp = $time->format('Y-m-d H:i:s');
echo 'addition is '.$stamp.'<br>';
//echo strtotime($stamp).'<br>';

$tt=strtotime($stamp);
echo (date("Y-m-d H:i:s",$tt)) .'<br>';








?>
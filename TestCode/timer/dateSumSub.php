<?php
	

echo time().'<br>';
$var = "2010-01-21 09:00:00";
echo strtotime($var).'<br>';

$var1 = "2010-1-21 9:00:0";
echo strtotime($var1).'<br>';
echo date('Y-m-d H:i:s').'<br>';


$a=strtotime("2010-01-21 09:10:00");
$b=strtotime("2010-1-21 9:0:00");
if($a>$b){
	echo "first date is bigger than second Date".'<br>';
}else if($a<$b){
	echo "first date is smaller than second Date".'<br>';
}else{
	echo "first date and  second Date are same".'<br>'.'<br>'.'<br>';
}



$t=time();
echo($t . "<br>");
echo(date("Y-m-d",$t)) .'<br>';
echo(date("Y-m-d H:i:s",$t)) .'<br>';
echo(date("H:i:s",$t)) .'<br>';



$c=strtotime("01:00:00");
echo $c.'<br>';
$d=strtotime("2010-1-21 1:0:00");
echo $d.'<br>';
$e=$d+$c;
echo ($e).'<br>';
echo(date("Y-m-d H:i:s",$e)) .'<br>';


$date=date_create("2013-03-15 01:00:00");
date_add($date,date_interval_create_from_date_string("01:00:00"));
echo date_format($date,"Y-m-d H:i:s").'<br>';

$date = new DateTime('2000-01-01');
$date->add(new DateInterval('PT10H30S'));
//$date->add(new DateInterval('P7Y5M4DT4H3M2S'));
echo $date->format('Y-m-d H:i:s') . "<br>";


//add datetime with duration

$hour_to_add = 01;
$minutes_to_add = 0;
$second_to_add = 1;
$time = new DateTime('2011-11-17 12:30:00');
$time->add(new DateInterval('PT' . $hour_to_add . 'H'.$minutes_to_add.'M'.$second_to_add.'S'));
$stamp = $time->format('Y-m-d H:i:s');
echo 'addition is '.$stamp.'<br>';
echo strtotime($stamp).'<br>';

$tt=strtotime($stamp);
echo (date("Y-m-d H:i:s",$tt)) .'<br>';


//diffrence of two date  (best choice)
$first=strtotime("2011-01-00 10:30:00");
$second=strtotime("2011-01-00 9:0:00");

$diffrence=$first-$second;
$s=gmdate("H:i:s",$diffrence);
echo 'difference is '.$s.'<br>';



/*
	//diffrence of two date 
	$date1=date_create("2019-01-00 10:30:00");
	$date2=date_create("2018-01-00 9:0:00");
	$diff=date_diff($date1,$date2);
	//echo $diff->format("%h:%i:%s");

	$difference2=$diff->format("%h:%i:%s");
	//$difference2=$diff->format("%y-%m-%d %h:%i:%s");
	echo 'difference is '.$difference2.'<br>';
	$tt2=strtotime($difference2);
	echo (date("H:i:s",$tt2)) .'<br>';

*/






?>

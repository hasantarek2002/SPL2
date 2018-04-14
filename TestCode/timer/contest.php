<?php
	session_start();
	include_once "connection.php";
	$sql="select * from timer where id= 1 ";
	$result = mysqli_query($conn, $sql);

	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	$initialTime=$row['startTime'];
	echo "Initial date is ".$initialTime.'<br>';

	$duration = $row['duration'];
	echo "duration date is ".$duration.'<br>';

	$splitDate = explode(":",$duration);
	$hour_to_add = $splitDate[0];
	$minutes_to_add = $splitDate[1];
	$second_to_add = $splitDate[2];

	//echo "hour is ".$splitDate[0].'<br>';
	//echo "minuite  is ".$splitDate[1].'<br>';
	//echo "second is ".$splitDate[2].'<br>';

	$time = new DateTime($initialTime);
	$time->add(new DateInterval('PT' . $hour_to_add . 'H'.$minutes_to_add.'M'.$second_to_add.'S'));
	$endTime = $time->format('Y-m-d H:i:s');
	
	echo 'addition is '.$endTime.'<br>';
	/*
	$tt=strtotime($endTime);
	echo (date("Y-m-d H:i:s",$tt)) .'<br>';
	*/
	$_SESSION['endTime']=$endTime;


?>
<center>
	
	<div id="response" style="font-size: 100px"></div>
</center>


<script type="text/javascript">
	setInterval (function(){
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","response.php",false);
		xmlhttp.send(null);
		document.getElementById("response").innerHTML=xmlhttp.responseText;
	},1000);


</script>
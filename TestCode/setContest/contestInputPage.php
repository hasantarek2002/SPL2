

<!DOCTYPE html>
<html>

	<head>
	    <meta charset="utf-8"/>
	    <title>contest set</title>
	</head>
<body onload="SetDate();">
	
	
	<script type="text/javascript">

		
		function validateContestData(){

			var contestName=document.forms["contestForm"]["contestName"].value;
			var startingTime=document.forms["contestForm"]["startingTime"].value;
			var duration=document.forms["contestForm"]["duration"].value;

			//var pattern=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
			var startingTimeRegex= /^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])[\s]([0-9]|0[0-9]|1?[0-9]|2[0-3]):[0-5]?[0-9]:[0-5]?[0-9]$/;;
			var durationRegex=/^([0-9]|0[0-9]|1?[0-9]|2[0-3]):[0-5]?[0-9]:[0-5]?[0-9]$/;

			if(!startingTimeRegex.test(startingTime)){
				alert("starting time must be in this format yyyy-mm-dd HH:MM:SS ");
				return false;
			}
			if(!durationRegex.test(duration)){
				alert("duration time must be in this format HH:MM:SS ");
				return false;
			}
			return true;
			
		}


	</script>



	<form name="contestForm" action="contestDataInsert.php" onsubmit="return validateContestData()" method="post" >
		
		contest name:<br>
		<input type="text" name="contestName" maxlength="50" required> <br>
		Starting time ( yyyy-mm-dd HH:MM:SS):<br>
		<input type="text" id="myDate" name="startingTime"  maxlength="50" size="50"   required> <br>
		contest Duration ( HH:MM:SS ):<br>
		<input type="text" id="time"  name="duration" maxlength="50" required> <br>

		<input type="submit" value="Continue" name="submit"> </input>

	</form>

	<script type="text/javascript">
		function SetDate()
		{
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			if (month < 10) month = "0" + month;
			if (day < 10) day = "0" + day;

			var h=date.getHours();
			var m=date.getMinutes();
			var s=date.getSeconds();
			var time="02:00:00";

			var timepart= h + ":" + m + ":" + s;
			
			var today = year + "-" + month + "-" + day +" "+timepart;
			
			document.getElementById('myDate').value = today;
			document.getElementById('time').value = time;
		}
	</script>
	

</body>
</html>
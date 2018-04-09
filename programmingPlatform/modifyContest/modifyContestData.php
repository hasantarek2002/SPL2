<?php
session_start();
?>

<?php

include_once "../connection.php";
$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";

$sql2 = "SELECT * FROM contest where contestId=$contestId";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);

$contestNameFromDatabase=$row2['contestName'];
$userNameFromDatabase=$row2['userName'];
$startingTimeFromDatabase=$row2['startingTime'];
$durationFromDatabase=$row2['duration'];


if(isset($_REQUEST["submit"])) {

	$contestName=$_POST['contestName'];
	$userName= $userNameFromDatabase;
	$startingTime= $_POST['startingTime'];
	$duration = $_POST['duration'];


	//$sql = "INSERT INTO contest (contestName, userName, startingTime, duration) VALUES ('$contestName', '$userName', '$startingTime', '$duration' )";

    $sql = "UPDATE contest SET contestName='$contestName', userName='$userName', startingTime='$startingTime', duration='$duration'  WHERE contestId=$contestId";
    //echo "updated contest name is ".$contestName .'<br>';
    //echo "updated starting time is  ".$startingTime . '<br>';
    //echo "updated duration is  ".$duration . '<br>';

    if(mysqli_query($conn, $sql)){
    	//echo "contest reference is added to database".'<br>';
        
        $lastId=$contestId;

        if (isset($_SESSION['contestId']))
        {
            //echo "session for color is already set".'<br>';
            $_SESSION['contestId']=$lastId;

            //unset($_SESSION['contestId']);
        }else{
            $_SESSION["contestId"] = $lastId;
            //echo "session for color is now set and the color is ".$_SESSION["favcolor"].'<br>';
        }
        $path="../setContest/setProblem.php";
        header('location:'.$path);
    }
    else{
    	echo "contest reference is not added to database".'<br>';
	}


}


?>






<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <title>contest set</title>
    </head>
<body>
    
    
    
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



    <form name="contestForm" onsubmit="return validateContestData()" method="post" >
        
        contest name:<br>
        <input type="text" id="contestName" name="contestName" value = "<?php echo $contestNameFromDatabase; ?>" maxlength="50" required> <br>
        Starting time ( yyyy-mm-dd HH:MM:SS):<br>
        <input type="text" id="myDate" name="startingTime" value = "<?php echo $startingTimeFromDatabase; ?>" maxlength="50" size="50"   required> <br>
        contest Duration ( HH:MM:SS ):<br>
        <input type="text" id="time"  name="duration" value="<?php echo $durationFromDatabase; ?>" maxlength="50" required> <br>

        <input type="submit" value="Continue" name="submit"> </input>

    </form>


    

    
    
</body>
</html>
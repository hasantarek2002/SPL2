<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
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


if(isset($_REQUEST["modify"])) {

	$contestName=$_POST['contestName'];
	$userName= $userNameFromDatabase;
	$startingTime= $_POST['startingTime'];
	$duration = $_POST['duration'];


	//$sql = "INSERT INTO contest (contestName, userName, startingTime, duration) VALUES ('$contestName', '$userName', '$startingTime', '$duration' )";

    $sql = "UPDATE contest SET contestName='$contestName', userName='$userName', startingTime='$startingTime', duration='$duration'  WHERE contestId='$contestId'";
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
    	//echo "contest reference is not added to database".'<br>';
        $path="../databaseErrorMessage.php";
        header('location:'.$path);
	}


}


?>

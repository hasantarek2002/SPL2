<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
?>

<?php
include_once ("../connection.php");


if(isset($_POST["submit"])) {

	$contestName=$_POST['contestName'];
	$userName= $_SESSION['userName'];
	$startingTime= $_POST['startingTime'];
	$duration = $_POST['duration'];


	$sql = "INSERT INTO contest (contestName, userName, startingTime, duration) VALUES ('$contestName', '$userName', '$startingTime', '$duration' )";
    //echo "contest name is ".$contestName .'<br>';
    //echo "starting time is  ".$startingTime . '<br>';
    //echo "duration is  ".$duration . '<br>';

    if(mysqli_query($conn, $sql)){
    	//echo "contest reference is added to database".'<br>';
        $lastId=mysqli_insert_id($conn);

        if (isset($_SESSION['contestId']))
        {
            //echo "session for color is already set".'<br>';
            $_SESSION['contestId']=$lastId;

            //unset($_SESSION['contestId']);
        }else{
            $_SESSION["contestId"] = $lastId;
            //echo "session for color is now set and the color is ".$_SESSION["favcolor"].'<br>';
        }
        header('location:setProblem.php');
    }
    else{
        $path="../databaseErrorMessage.php";
    	header('location:'.$path);
	}


}


?>
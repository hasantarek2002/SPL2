<?php
// Start the session
session_start();
?>

<?php
include "connection.php";


if(isset($_POST["submit"])) {

	$contestName=$_POST['contestName'];
	$userName= "admin";
	$startingTime= $_POST['startingTime'];
	$duration = $_POST['duration'];


	$sql = "INSERT INTO contest (contestName, userName, startingTime, duration) VALUES ('$contestName', '$userName', '$startingTime', '$duration' )";
    echo "contest name is ".$contestName .'<br>';
    echo "starting time is  ".$startingTime . '<br>';
    echo "duration is  ".$duration . '<br>';

    if(mysqli_query($conn, $sql)){
    	echo "contest reference is added to database".'<br>';
        
        /*$sql2="SELECT contestId FROM contest ORDER BY contestId DESC";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $lastId = $row2['contestId']+1;
        */
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
    	echo "contest reference is not added to database".'<br>';
	}


}


?>
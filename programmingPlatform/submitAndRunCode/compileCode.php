<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'user') ){
        $path="../error.php";
	 	header('location:'.$path);
	 }
?>

<?php
    if(isset($_REQUEST['submit'])){
        include_once "../connection.php";
        $selectedLanguage=$_REQUEST['selectedLanguage'];
        $submittedCode=$_REQUEST['code'];
        $problemId = isset($_GET['problemId'])? $_GET['problemId'] : "";
        $contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
        //$userName="hasan";
        $userName=$_SESSION['userName'];

        $sql="SELECT * FROM problem WHERE problemId=$problemId ";
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $inputFile=$row['inputFile'];
        $solutionFile=$row['solutionFile'];
        $timeLimit=$row['timeLimit'];
        $problemName=$row['problemName'];

        //set actual directory
        $inputFile="../setContest/".$inputFile;
        $solutionFile="../setContest/".$solutionFile;


        if($selectedLanguage =="C"){
            include "CCode/c.php";
        }else if ($selectedLanguage == "C++") {
            include "CPPCode/cpp.php";
        }

        //echo "Verdict is".$verdict.'<br>';
        $sql2="INSERT INTO submission (problemId, problemName, contestId, userName, compiler, verdict) VALUES ('$problemId','$problemName','$contestId','$userName','$selectedLanguage', '$verdict') ";

        if(mysqli_query($conn, $sql2) ){
            //echo "data inserted into submission table<br>";
            header('location:showSubmissionList.php');
        }else{
            echo "data not inserted into submission table<br>";
            //$path2="../databaseErrorMessage.php";
            //header('location:'.$path2);
        }
    }
?>
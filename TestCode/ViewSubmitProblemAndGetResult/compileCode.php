<?php
if(isset($_REQUEST['submit'])){
	include_once ("connection.php");
	$selectedLanguage=$_REQUEST['selectedLanguage'];
	$submittedCode=$_REQUEST['code'];
	$problemId = isset($_GET['problemId'])? $_GET['problemId'] : "";
	$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
	//$userName="hasan";
	$userName="shihab";
	//echo "compile code =>contest id".$contestId.'<br>';
	//echo "problem id is ".$problemId.'<br>';
	//echo '<br>'."compile page".'<br>'.$_REQUEST['code'].'<br>'.$_REQUEST['selectedLanguage'];
	//include "aa.php";

	$sql="SELECT * FROM problem WHERE problemId=$problemId ";
	$result = mysqli_query($conn, $sql);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	$inputFile=$row['inputFile'];
	$solutionFile=$row['solutionFile'];
	$timeLimit=$row['timeLimit'];
	$problemName=$row['problemName'];
	

	if($selectedLanguage =="C"){
		include "CCode/c.php";
	}else if ($selectedLanguage == "C++") {
		include "CPPCode/cpp.php";
	}

	//echo "Verdict is".$verdict.'<br>';
	$sql2="INSERT INTO submission (problemId, problemName, contestId, userName, compiler, verdict) VALUES ('$problemId','$problemName','$contestId','$userName','$selectedLanguage', '$verdict') ";
	
	if(mysqli_query($conn, $sql2) ){
		echo "data inserted into submission table<br>";
	}else{
		echo "data not inserted into submission table<br>";
	}








}else{
	echo "button click kore nai";
}
?>
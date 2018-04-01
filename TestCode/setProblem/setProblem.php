<?php
	include "connection.php";
	showTable();	

	if(isset($_REQUEST["delId"])){
		$delId=$_REQUEST["delId"];

		$sql4 = "SELECT * FROM problem where problemId='$delId' ";
		$result2=mysqli_query($conn, $sql4);

		if (mysqli_num_rows($result2) > 0) {
	   		$row2 = mysqli_fetch_assoc($result2);
	   		$questionFileToDelete=$row2['questionFile'];
	   		$inputFileToDelete=$row2['inputFile'];
	   		$solutionFileToDelete=$row2['solutionFile'];

	   		unlink($questionFileToDelete);
	   		unlink($inputFileToDelete);
	   		unlink($solutionFileToDelete); 
			/*if (!unlink($questionFileToDelete) && !unlink($inputFileToDelete) && !unlink($solutionFileToDelete) )
			{
			  alert("Error deleting files");
			}
			else
			{
			  echo "Files deleted successfully";
			}*/

			$sql3 = "DELETE FROM problem where problemId='$delId' ";
			mysqli_query($conn, $sql3);
		}
		header('location:setProblem.php');
		//showTable();

	}



?>



<?php
function showTable() {
    //echo "Hello world!";
    include "connection.php";
    $sql2 = "SELECT * FROM problem";
	$result = mysqli_query($conn, $sql2);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    echo "<table border='1' align='center'><tr> <th>id</th> <th>problem name</th> <th>Time Limit</th>  <th>input file</th> <th>Solution file</th><th>Question file</th> <th>Delete</th></tr>";
	    while($row = mysqli_fetch_assoc($result)) {
	    	//echo '<tr> <td>'.$row["id"].'</td> <td>'. $row["file"].'</td>  </tr>';
	    	echo "<tr> <td>".$row['problemId'].'</td><td>'.$row['problemName'].'</td><td>'.$row['timeLimit'].'</td><td>'.$row['inputFile'].'</td><td>'.$row['solutionFile'].'</td><td>';

	    	echo "<a href='viewPDFFileUsingTable.php?id=".$row['problemId']."' target='_blank'>".$row['questionFile']."</a>".'</td><td>';
	    	echo "<a href='setProblem.php?delId=".$row['problemId']."' >"."Delete"."</a>".'</td></tr>';

	        
	    }
	    echo "</table>";
	} 
	//mysqli_close($conn);
}

?>


<?php

include "connection.php";

if(isset($_POST["submit"])) {

	$problemName=$_POST['problemName'];
	$timeLimit=$_POST['timeLimit'];

	$target_dir = "uploads/";
	$questionFileType = strtolower(pathinfo(basename($_FILES["questionFile"]["name"]),PATHINFO_EXTENSION));
	$inputFileType = strtolower(pathinfo(basename($_FILES["inputFile"]["name"]),PATHINFO_EXTENSION));
	$solutionFileType = strtolower(pathinfo(basename($_FILES["solutionFile"]["name"]),PATHINFO_EXTENSION));


	$sql5="SELECT problemId FROM problem ORDER BY problemId DESC";
	$result5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_assoc($result5);
	$lastId = $row5['problemId']+1;
	$renameFile=strval($lastId);

	$uploadOk = 1;

	if($questionFileType == "pdf"){
		//$renameFile=strval($lastId);
		$f= 'q'.$renameFile.'.pdf';
		@rename(basename($_FILES["questionFile"]["name"]), $f);
		$questionTargetFile = $target_dir . $f;
	}else{
		$uploadOk = 0;
	}
	if($inputFileType == "txt"){	
		$f= 'i'.$renameFile.'.txt';
		@rename(basename($_FILES["inputFile"]["name"]), $f);
		$inputTargetFile = $target_dir . $f;
	}else{
		$uploadOk = 0;
	}
	if($solutionFileType == "txt"){	
		$f= 's'.$renameFile.'.txt';
		@rename(basename($_FILES["solutionFile"]["name"]), $f);
		$solutionTargetFile = $target_dir . $f;
	}else{
		$uploadOk = 0;
	}


	//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

	echo 'Base question file name is '.basename($_FILES["questionFile"]["name"]).'<br>';
	echo 'uploaded question file is '.$questionTargetFile.'<br>';
	echo 'uploaded question file type is '.$questionFileType.'<br>';

	echo 'Base input file name is '.basename($_FILES["inputFile"]["name"]).'<br>';
	echo 'uploaded input file is '.$inputTargetFile.'<br>';
	echo 'uploaded input file type is '.$inputFileType.'<br>';

	echo 'Base output file name is '.basename($_FILES["solutionFile"]["name"]).'<br>';
	echo 'uploaded output file is '.$solutionTargetFile.'<br>';
	echo 'uploaded output file type is '.$solutionFileType.'<br>';



	// Check if file already exists
	if (file_exists($questionTargetFile)) {
	    echo "Sorry, question file already exists.";
	    $uploadOk = 0;
	}
	if (file_exists($inputTargetFile)) {
	    echo "Sorry, input file already exists.";
	    $uploadOk = 0;
	}
	if (file_exists($solutionTargetFile)) {
	    echo "Sorry, output file already exists.";
	    $uploadOk = 0;
	}

	// Check file size 1000*1000
	if ($_FILES["questionFile"]["size"] > 5000000) {
	    echo "Sorry, your question file is too large.(max 5MB)";
	    $uploadOk = 0;
	}
	if ($_FILES["inputFile"]["size"] > 5000000) {
	    echo "Sorry, your input file is too large.(max 5MB)";
	    $uploadOk = 0;
	}
	if ($_FILES["solutionFile"]["size"] > 5000000) {
	    echo "Sorry, your output file is too large.(max 5MB)";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($questionFileType != "pdf" && $inputFileType != "txt" && $solutionFileType != "txt" ) {
	    echo "Sorry, question file must be pdf and input , output file must be in text format";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else {
		echo "temporary file name is :: ".$_FILES["questionFile"]["tmp_name"].'<br>';
	    if (move_uploaded_file($_FILES["questionFile"]["tmp_name"], $questionTargetFile) && move_uploaded_file($_FILES["inputFile"]["tmp_name"], $inputTargetFile) && move_uploaded_file($_FILES["solutionFile"]["tmp_name"], $solutionTargetFile)) {

	    	$sql = "INSERT INTO problem (problemName, timeLimit, questionFile, inputFile, solutionFile) VALUES ('$problemName', '$timeLimit', '$questionTargetFile', '$inputTargetFile', '$solutionTargetFile')";
	        echo "The question file ".$questionTargetFile . " has been uploaded.".'<br>';
	        echo "The input file ".$inputTargetFile . " has been uploaded.".'<br>';
	        echo "The output file ".$solutionTargetFile . " has been uploaded.".'<br>';

	        if(mysqli_query($conn, $sql)){
	        	echo "file reference is added to database".'<br>';
	        }
	        else{
	        	echo "file reference is not added to database".'<br>';
	        }



	    }
	     else {
	        echo "Sorry, there was an error uploading your file.";
	    }

	    
	}
	header('location:setProblem.php');
	//showTable();	    
}
 


?>


<!DOCTYPE html>
<html>

	<head>
	    <meta charset="utf-8"/>
	    <title>file upload</title>
	</head>
<body>
	
	<script>

		function getExtension(filename) {
		    var parts = filename.split('.');
		    return parts[parts.length - 1];
		}

		function validateExtensionOfFile(){

			var problemName=document.forms["fileUpload"]["problemName"].value;
			var questionFile=document.forms["fileUpload"]["questionFile"].value;
			var inputFile=document.forms["fileUpload"]["inputFile"].value;
			var solutionFile=document.forms["fileUpload"]["solutionFile"].value;

			var questionFileExtension=getExtension(questionFile);
			var inputFileExtension=getExtension(inputFile);
			var solutionFileExtension=getExtension(solutionFile);

			if(questionFileExtension != "pdf"){
				alert("qustion file must be pdf");
				return false;
			}
			if(inputFileExtension != "txt"){
				alert("input file must be text type.");
				return false;
			}
			if(solutionFileExtension != "txt"){
				alert("solutuon file must be text type.");
				return false;
			}
			return true;
			
		}


	</script>



	<form name="fileUpload" onsubmit="return validateExtensionOfFile()" method="post" enctype="multipart/form-data">
		
		problem name:<br>
		<input type="text"  name="problemName" maxlength="50" required> <br>
		time limit:<br>
		<input type="number" name="timeLimit" value="2" min="1" max="5" required> <br>
		select question file(pdf) to Upload:<br>
		<input type="file"  name="questionFile" required> <br>
		select input test file(txt) to Upload:<br>
		<input type="file"  name="inputFile" required> <br>
		select solution file (txt)to Upload:<br>
		<input type="file"  name="solutionFile" required> <br>

		<input type="submit" value="upload" name="submit"> </input>

	</form>

</body>
</html>
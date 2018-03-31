<?php
	include "connection.php";
	showTable();	

	if(isset($_REQUEST["delId"])){
		$delId=$_REQUEST["delId"];

		$sql4 = "SELECT * FROM fileUpload where id='$delId' ";
		$result2=mysqli_query($conn, $sql4);

		if (mysqli_num_rows($result2) > 0) {
	   		$row2 = mysqli_fetch_assoc($result2);
	   		$fileToDelete=$row2['file'];

			if (!unlink($fileToDelete))
			{
			  alert("Error deleting $fileToDelete");
			}
			else
			{
			  echo ("Deleted $fileToDelete");
			}

			$sql3 = "DELETE FROM fileUpload where id='$delId' ";
			mysqli_query($conn, $sql3);
		}
		header('location:fileUploadPageWithUploadedFIleList.php');
		//showTable();

	}



?>



<?php
function showTable() {
    //echo "Hello world!";
    include "connection.php";
    $sql2 = "SELECT * FROM fileUpload";
	$result = mysqli_query($conn, $sql2);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    echo "<table border='1' align='center'><tr> <th>id</th> <th>file location</th> <th>Delete</th></tr>";
	    while($row = mysqli_fetch_assoc($result)) {
	    	//echo '<tr> <td>'.$row["id"].'</td> <td>'. $row["file"].'</td>  </tr>';
	    	echo "<tr> <td>".$row['id'].'</td><td>';

	    	echo "<a href='viewPDFFileUsingTable.php?id=".$row['id']."' target='_blank'>".$row['file']."</a>".'</td><td>';
	    	echo "<a href='fileUploadPageWithUploadedFIleList.php?delId=".$row['id']."' >"."Delete"."</a>".'</td></tr>';

	        
	    }
	    echo "</table>";
	} 
	//mysqli_close($conn);
}

?>


<?php

include "connection.php";

if(isset($_POST["submit"])) {

	$target_dir = "uploads/";
	$fileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));

	if($fileType == "txt"){
		@rename(basename($_FILES["fileToUpload"]["name"]), "ccc.txt");
		$target_file = $target_dir . "ccc.txt";
	}

	if($fileType == "pdf"){
		@rename(basename($_FILES["fileToUpload"]["name"]), "ccc.pdf");
		$target_file = $target_dir . "ccc.pdf";
	}


	//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

	echo 'Base file name is '.basename($_FILES["fileToUpload"]["name"]).'<br>';
	echo 'uploaded file is '.$target_file.'<br>';
	$uploadOk = 1;

	echo 'uploaded file type is '.$fileType.'<br>';



	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($fileType != "txt" && $fileType != "pdf" ) {
	    echo "Sorry, only txt and pdf  files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else {
		//echo "temporary file name is :: ".$_FILES["fileToUpload"]["tmp_name"].'<br>';
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	    	$sql="insert into fileUpload (file) values ('$target_file')";
	        echo "The file ".$target_file . " has been uploaded.".'<br>';

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
	header('location:fileUploadPageWithUploadedFIleList.php');
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
			var filename=document.forms["fileUpload"]["fileToUpload"].value;
			var extension=getExtension(filename);

			if(extension == "pdf" || extension =="txt"){
				
				return true;
			}
			alert("file must be pdf or text");
			return false;

			
		}


	</script>



	<form name="fileUpload" onsubmit="return validateExtensionOfFile()" method="post" enctype="multipart/form-data">
		File Upload:<br>
		<input type="file"  name="fileToUpload" required> <br>

		<input type="submit" value="upload" name="submit"> </input>

	</form>

</body>
</html>
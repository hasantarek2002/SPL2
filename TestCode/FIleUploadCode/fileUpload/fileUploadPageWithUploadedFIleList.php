
<?php

include "connection.php";

if(isset($_POST["submit"])) {
	

	
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


		        $sql2 = "SELECT * FROM fileUpload";
				$result = mysqli_query($conn, $sql2);

				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    echo "<table><tr> <th>id</th> <th>location</th> </tr>";
				    while($row = mysqli_fetch_assoc($result)) {
				    	echo '<tr> <td>'.$row["id"].'</td> <td>'. $row["file"].'</td>  </tr>';

				        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
				    }
				    echo "</table>";
				} 



		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}	    
	}
 
}

?>


<!DOCTYPE html>
<html>

	<head>
	    <meta charset="utf-8"/>
	    <title>file upload</title>
	</head>
<body>


	<form method="post" enctype="multipart/form-data">
		File Upload:<br>
		<input type="file"  name="fileToUpload" required> <br>

		<input type="submit" value="upload" name="submit"> </input>

	</form>

</body>
</html>
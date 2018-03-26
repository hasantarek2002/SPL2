
<?php

include "connection.php";
$target_dir = "uploads/";
$fileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));

if($fileType == "txt"){
	@rename(basename($_FILES["fileToUpload"]["name"]), "aaa.txt");
	$target_file = $target_dir . "aaa.txt";
}

if($fileType == "pdf"){
	@rename(basename($_FILES["fileToUpload"]["name"]), "aaa.pdf");
	$target_file = $target_dir . "aaa.pdf";
}


//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

echo 'Base file name is '.basename($_FILES["fileToUpload"]["name"]).'<br>';
echo 'uploaded file is '.$target_file.'<br>';
$uploadOk = 1;

echo 'uploaded file type is '.$fileType.'<br>';
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
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
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}


    
}




?>

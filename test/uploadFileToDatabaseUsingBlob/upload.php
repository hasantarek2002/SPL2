
<?php
include "connection.php";

//$stmt = $conn->prepare("INSERT INTO file (name, question, input, output) VALUES (?, ?, ?, ?)");
//$stmt->bind_param("sbbb",$name, $question, $input, $output);

//$sql = "INSERT INTO MyGuests (firstname, lastname, email)
//VALUES ('John', 'Doe', 'john@example.com')";

if(isset($_POST["submit"])) {
	$name=$_POST["problemName"];
	$question=$_FILES['question']['name'];
	$input=$_FILES['input']['name'];
	$output=$_FILES['output']['name'];
	
	
	$sql="INSERT INTO file (name, question, input, output) VALUES ('$name', '$question', '$input', '$output')";
	if (mysqli_query($conn, $sql)) {
    	echo "New record created successfully".'<br>';
    	echo "question type ".$_FILES['question']['type'].'<br>';
    	echo "input type ".$_FILES['input']['type'].'<br>';
    	echo "output type ".$_FILES['output']['type'].'<br>';

    	
	} 
	else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	/*
	$stmt->execute();
	
	echo "files are successfully inserted";
	$stmt->close();
	*/
	/*
	$type=	$_FILES['question']['type'];
	$size=$_FILES['question']['size'];
   echo "<br>".$question;
   echo "<br>".$type;
   echo "<br>".$size;
   */
}

mysqli_close($conn);

?>


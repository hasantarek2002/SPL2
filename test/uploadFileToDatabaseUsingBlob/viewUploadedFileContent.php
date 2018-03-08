<?php
include "connection.php";

$id = isset($_GET['id'])? $_GET['id'] : "";
$columName = isset($_GET['columName'])? $_GET['columName'] : "";

$sql="select $columName from file where id= $id";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

//echo "colum name is ".$columName.'<br>';
//echo "file name is ".$row[$columName];

//echo "selected file type  is ".mime_content_type($row[$columName]);

//echo $row['question'];
//echo "file name is ".$row[$columName];
$file = $row[$columName];
$data=file_get_contents($file);
echo $data;

if ($columName==="question"){
	$file = $row[$columName];
	$filename = $row[$columName];
	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Accept-Ranges: bytes');
	@readfile($file);
	
}
else{
	header("Content-Type: text/plain");
	echo $row[$columName];
}

/*
if ( $columName ==="question"){
	header("Content-Type: application/pdf");
	
	echo $row[$columName];
}
else{
	header("Content-Type: text/plain");
	echo $row[$columName];
}
*/

//header("Content-Type:".mime_content_type($result['$columName']));
//echo $result['$columName'];


//header("Content-Type:".$row['mime']);
//echo $row['data'];
//echo '<img src="data:image/jpeg;base64,'.base64_encode($row['data']).'"/>';

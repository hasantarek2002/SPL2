<?php
include "connection.php";

$id = isset($_GET['id'])? $_GET['id'] : "";

$sql="select file from fileUpload where id= $id";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);


$file = $row['file'];
$filename = $row['file'];
//echo "file location  is ".$file.'<br>';

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);


//echo "file name is ".$row[$columName];

//echo "selected file type  is ".mime_content_type($row[$columName]);

//echo $row['question'];
//echo "file name is ".$row[$columName];
//$file = $row[$columName];
//$data=file_get_contents($file);
//echo $data;

?>

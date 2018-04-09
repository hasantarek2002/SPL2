<?php
include_once "../connection.php";

$id = isset($_GET['id'])? $_GET['id'] : "";

$sql="select questionFile from problem where problemId= $id ";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);


$file = $row['questionFile'];
$filename = $row['questionFile'];
//echo "file location  is ".$file.'<br>';

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);



?>

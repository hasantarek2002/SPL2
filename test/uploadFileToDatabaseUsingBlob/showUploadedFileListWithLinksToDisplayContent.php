<?php

include "connection.php";

$sql = "SELECT id, name, question, input, output FROM file";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table><tr> <th>id</th> <th>problem name</th>  <th>question name</th>  <th>input file name</th> <th>output file name</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
    	echo "<tr> <td>".$row['id'].'</td><td>'.$row['name'].'</td><td>';
    	//echo "<li><a href='viewUploadedFileContent.php?id=".$row['id']."' target='_blank'>".$row['name']."</a></li>";
    	/*
    	echo "<li><a href='viewUploadedFileContent.php?id=".$row['id'].'&name='.$row['question']."' target='_blank'>".$row['question']."</a></li>".'</td><td>';
    	
    	echo "<li><a href='viewUploadedFileContent.php?id=".$row['id'].'&name='.$row['input']."' target='_blank'>".$row['input']."</a></li>".'</td><td>';
    	
    	echo "<li><a href='viewUploadedFileContent.php?id=".$row['id'].'&name='.$row['output']."' target='_blank'>".$row['output']."</a></li>".'</td></tr>';
    	
    	*/
    	
    	echo "<li><a href='viewUploadedFileContent.php?id=".$row['id'].'&columName=question'."' target='_blank'>".$row['question']."</a></li>".'</td><td>';
    	
    	echo "<li><a href='viewUploadedFileContent.php?id=".$row['id'].'&columName=input'."' target='_blank'>".$row['input']."</a></li>".'</td><td>';
    	
    	echo "<li><a href='viewUploadedFileContent.php?id=".$row['id'].'&columName=output'."' target='_blank'>".$row['output']."</a></li>".'</td></tr>';
    }
    echo "</table>";
} 
else{
    echo "0 results";
}

?>

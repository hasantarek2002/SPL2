<?php
include "connection.php";
	$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
    $sql2 = "SELECT * FROM problem where contestId=$contestId";
	$result = mysqli_query($conn, $sql2);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    echo "<table border='1' align='center'><tr> <th>problem id</th><th>contest id</th> <th>problem name</th> <th>Time Limit</th>  <th>input file</th> <th>Solution file</th><th>Question file</th></tr>";
	    while($row = mysqli_fetch_assoc($result)) {
	    	//echo '<tr> <td>'.$row["id"].'</td> <td>'. $row["file"].'</td>  </tr>';
	    	echo "<tr> <td>".$row['problemId'].'</td><td>'.$row['contestId'].'</td><td>'.$row['problemName'].'</td><td>'.$row['timeLimit'].'</td><td>'.$row['inputFile'].'</td><td>'.$row['solutionFile'].'</td><td>';

	    	echo "<a href='viewPDFFileUsingTable.php?id=".$row['problemId']."' target='_blank'>".$row['questionFile']."</a>".'</td></tr>';

	        
	    }
	    echo "</table>";
	} 
?>
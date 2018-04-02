<?php
include "connection.php";
    $sql = "SELECT * FROM contest";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    echo "<table border='1' align='center'><tr> <th>contest id</th> <th>contest name</th> <th>Contest setter</th>  <th>Starting time </th> <th>Duration</th></tr>";
	    while($row = mysqli_fetch_assoc($result)) {
	    	
	    	//echo "<tr> <td>".$row['contestId'].'</td><td>'.$row['contestName'].'</td><td>'.$row['userName'].'</td><td>'.$row['startingTime'].'</td><td>'.$row['duration'].'</td></tr>';
	    	echo "<tr> <td>".$row['contestId'].'</td><td>';
	    	echo "<a href='showFinalProblemListForAContestForAdmin.php?contestId=".$row['contestId']."' target='_blank'>".$row['contestName']."</a>".'</td><td>';

	    	echo $row['userName'].'</td><td>'.$row['startingTime'].'</td><td>'.$row['duration'].'</td></tr>';

	        
	    }
	    echo "</table>";
	}else{

		echo "No contest found".'<br>';
	}
?>
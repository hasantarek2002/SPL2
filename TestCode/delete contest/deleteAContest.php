<?php
	include "connection.php";

	if(isset($_REQUEST["delId"])){
		$delId=$_REQUEST["delId"];

		$sql2 = "SELECT * FROM problem where contestId=$delId ";
		$result2=mysqli_query($conn, $sql2);


		if (mysqli_num_rows($result2) > 0) {
			while($row2 = mysqli_fetch_assoc($result2)) {	    	
				$questionFileToDelete=$row2['questionFile'];
		   		$inputFileToDelete=$row2['inputFile'];
		   		$solutionFileToDelete=$row2['solutionFile'];

		   		unlink($questionFileToDelete);
		   		unlink($inputFileToDelete);
		   		unlink($solutionFileToDelete); 
	        
	    	}
			$sql3 = "DELETE FROM problem where contestId='$delId' ";
			mysqli_query($conn, $sql3);
		}
		$sql4 = "DELETE FROM contest where contestId='$delId' ";
		mysqli_query($conn, $sql4);
		header('location:deleteAContest.php');
	}



?>


<?php
include "connection.php";
    $sql = "SELECT * FROM contest";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    echo "<table border='1' align='center'><tr> <th>contest id</th> <th>contest name</th> <th>Contest setter</th>  <th>Starting time </th> <th>Duration</th><th>Delete </th></tr>";
	    while($row = mysqli_fetch_assoc($result)) {
	    	
	    	//echo "<tr> <td>".$row['contestId'].'</td><td>'.$row['contestName'].'</td><td>'.$row['userName'].'</td><td>'.$row['startingTime'].'</td><td>'.$row['duration'].'</td><td>';
	    	//echo "<a href='deleteAContest.php?delId=".$row['contestId']."' >"."Delete"."</a>".'</td></tr>';
	    	echo "<tr> <td>".$row['contestId'].'</td><td>'.$row['contestName'].'</td><td>'.$row['userName'].'</td><td>'.$row['startingTime'].'</td><td>'.$row['duration'].'</td><td>';
	    	echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='deleteAContest.php?delId=".$row['contestId']."' >"."Delete"."</a>".'</td></tr>';

	        
	    }
	    echo "</table>";
	}else{

		echo "No contest found".'<br>';
	}
?>
<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
?>



<?php
	include_once "../connection.php";

	if(isset($_REQUEST["delId"])){
		$delId=$_REQUEST["delId"];

		$sql2 = "SELECT * FROM problem where contestId=$delId ";
		$result2=mysqli_query($conn, $sql2);


		if (mysqli_num_rows($result2) > 0) {
			while($row2 = mysqli_fetch_assoc($result2)) {	    	
				$questionFileToDelete=$row2['questionFile'];
		   		$inputFileToDelete=$row2['inputFile'];
		   		$solutionFileToDelete=$row2['solutionFile'];
                $questionFileToDelete="../setContest/".$questionFileToDelete;
                $inputFileToDelete="../setContest/".$inputFileToDelete;
                $solutionFileToDelete="../setContest/".$solutionFileToDelete;

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

<!DOCTYPE html>  
 <html> 
      <head>
      <title>Delete Contest</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../DataTables/datatables.min.js"></script>

        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
     
     

    <body> 
        <nav class="navbar ">
          <div class="container-fluid">

            <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>  
                <div class="navbar-header">
                  <a class="navbar-brand" href="../adminHomepage.php">Programming Platform</a>
                </div>
            <?php } else { ?>
              <div class="navbar-header">
                  <a class="navbar-brand" href="../userHomepage.php">Programming Platform</a>
                </div>
            <?php }  ?>

            <ul class="nav navbar-nav">
                <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>  
                    <li class="active"><a href="../adminHomepage.php">Home</a></li>
                <?php } else { ?>
                    <li class="active"><a href="../userHomepage.php">Home</a></li>
                <?php }  ?>

              <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Contest <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="../showContestList/showListOfContestsForAdmin.php">Show Contest</a></li>
                  <li><a href="../setContest/contestInputPage.php">Set new contest</a></li>
                  <li><a href="../modifyContest/modifyContest.php">Edit contest</a></li>
                  <li><a href="deleteAContest.php">Delete contest</a></li>
                </ul>
              </li>
                <li><a href="../showContestList/showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
              <?php } else { ?>
              <li><a href="../showContestList/showListOfContestsForUser.php">Contests</a></li>
                <li><a href="../showContestList/showUpcomingContestListForUser.php">Upcoming Contests</a></li>
              <?php }  ?>


              <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'user') { ?>
                <li><a href="../submitAndRunCode/showSubmissionList.php">Submissions</a></li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="../profile/showProfile.php">Profile</a></li>
                  <li><a href="../profile/showSubmissionListForAUser.php">My Submissions</a></li>
                </ul>
              </li>
                <?php } else { ?>
                <li><a href="../profile/showProfile.php">Profile</a></li>
                <?php }  ?>
            </ul>


            <?php if(!isset($_SESSION['userName'])) { ?>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            <?php } else { ?>
              <ul class="nav navbar-nav navbar-right">
              <li><a href="../profile/showProfile.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['userName'] ?></a></li>
              <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
            <?php }  ?>

          </div>
        </nav>
        
        <div class="container">  
                <h3 align="center">Delete Contest</h3>  
                <br /> 
            <?php 
                $sql = "SELECT * FROM contest";
	            $result = mysqli_query($conn, $sql);
            ?>
                <div class="table-responsive">  
                     <table id="contestData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Contest ID</td>  
                                    <td>Contest Name</td>  
                                    <td>Starting time</td>  
                                    <td>Duration</td>
                                   <td>Delete</td>
                               </tr>  
                          </thead> 
                          <?php
                          while($row = mysqli_fetch_array($result))  
                          {  

                            echo '<tr>
                                <td>'.$row["contestId"].'</td>
                                <td>'.$row["contestName"].'</td>
                                <td>'.$row["startingTime"].'</td>
                                <td>'.$row["duration"].'</td>
                                <td>';
                                echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='deleteAContest.php?delId=".$row['contestId']."' >"."Delete"."</a>".'</td></tr>';
                          }  
                          ?>  
                     </table>  
                </div>  
           </div> 
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#contestData').DataTable(
      {
        "order": [[ 0, "desc" ]]
        } 
      );  
 });  
 </script>  



<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
?>


<?php

    include "../connection.php";
    $contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";

    $sql2 = "SELECT * FROM contest where contestId=$contestId";
    $result2 = mysqli_query($conn, $sql2);
    $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);

    $contestNameFromDatabase=$row2['contestName'];
    //$userNameFromDatabase=$row2['userName'];
    $startingTimeFromDatabase=$row2['startingTime'];
    $durationFromDatabase=$row2['duration'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>contest input page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
    <script type="text/javascript" src="../DataTables/datatables.min.js"></script>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body >
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
                  <li><a href="../deleteContest/deleteAContest.php">Delete contest</a></li>
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
    
    
    
	<script type="text/javascript">
	   function validateContestData(){
			var contestName=document.forms["contestForm"]["contestName"].value;
			var startingTime=document.forms["contestForm"]["startingTime"].value;
			var duration=document.forms["contestForm"]["duration"].value;

			//var pattern=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
			var startingTimeRegex= /^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])[\s]([0-9]|0[0-9]|1?[0-9]|2[0-3]):[0-5]?[0-9]:[0-5]?[0-9]$/;;
			var durationRegex=/^([0-9]|0[0-9]|1?[0-9]|2[0-3]):[0-5]?[0-9]:[0-5]?[0-9]$/;

			if(!startingTimeRegex.test(startingTime)){
				alert("starting time must be in this format yyyy-mm-dd HH:MM:SS ");
				return false;
			}
			if(!durationRegex.test(duration)){
				alert("duration time must be in this format HH:MM:SS ");
				return false;
			}
			return true;
			
		}


	</script>

    <div class="container">
	  <h2>Contest Data Modification</h2>
	  <form name="contestForm" action='modifyContestData.php?contestId=<?php echo $contestId; ?>' onsubmit="return validateContestData()" method="post">
	    <div class="form-group">
	      <label for="contest-name">Contest Name:</label>
	      <input type="text" class="form-control" name="contestName" value="<?php echo $contestNameFromDatabase; ?>" required>
	    </div>
	    <div class="form-group">
	      <label for="starting-time">Starting time ( yyyy-mm-dd HH:MM:SS):</label>
	      <input type="text" class="form-control" id="myDate" name="startingTime" value="<?php echo $startingTimeFromDatabase; ?>" maxlength="50" size="50"   required>
	    </div>
        <div class="form-group">
	      <label for="contest-duration">contest Duration ( HH:MM:SS </label>
	      <input type="text" class="form-control" id="time"  name="duration" value="<?php echo $durationFromDatabase; ?>" maxlength="50" required>
	    </div>  
        
	    
	    <input type="submit" class="btn btn-success" name="modify" value="Continue" >
	  </form>
	</div>

	

</body>
</html>
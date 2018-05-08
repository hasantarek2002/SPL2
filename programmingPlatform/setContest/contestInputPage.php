<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
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
<body onload="SetDate();">
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
              <li><a href="contestInputPage.php">Set new contest</a></li>
              <li><a href="../modifyContest/modifyContest.php">Edit contest</a></li>
              <li><a href="../deleteContest/deleteAContest.php">Delete contest</a></li>
            </ul>
              <li><a href="../showContestList/showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
          </li>
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
			//var startingTimeRegex= /^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])[\s]([0-9]|0[0-9]|1?[0-9]|2[0-3]):[0-5]?[0-9]:[0-5]?[0-9]$/;;
           var startingTimeRegex= /^\d{4}[\-](0[1-9]|1[012])[\-](0[1-9]|[12][0-9]|3[01])[\s](0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/; 
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
	  <h2>Contest Input</h2>
	  <form name="contestForm" action="contestDataInsert.php" onsubmit="return validateContestData()" method="post">
	    <div class="form-group">
	      <label for="contest-name">Contest Name:</label>
	      <input type="text" class="form-control" placeholder="Enter contest name" name="contestName" required>
	    </div>
	    <div class="form-group">
	      <label for="starting-time">Starting time ( yyyy-mm-dd HH:MM:SS):</label>
	      <input type="text" class="form-control" id="myDate" name="startingTime"  maxlength="50" size="50"   required>
	    </div>
        <div class="form-group">
	      <label for="contest-duration">contest Duration ( HH:MM:SS </label>
	      <input type="text" class="form-control" id="time"  name="duration" maxlength="50" required>
	    </div>  
        
	    
	    <input type="submit" class="btn btn-success" value="Continue" name="submit"> 
	  </form>
	</div>


	<script type="text/javascript">
		function SetDate()
		{
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			if (month < 10) month = "0" + month;
			if (day < 10) day = "0" + day;

			var h=date.getHours();
			var m=date.getMinutes();
			var s=date.getSeconds();
			var time="02:00:00";

			var timepart= h + ":" + m + ":" + s;
			
			var today = year + "-" + month + "-" + day +" "+timepart;
			
			document.getElementById('myDate').value = today;
			document.getElementById('time').value = time;
		}
	</script>
	

</body>
</html>
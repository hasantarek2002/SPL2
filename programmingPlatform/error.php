<!DOCTYPE html>
<html lang="en">
<head>
  <title>Error </title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar">
      <div class="container-fluid">

        <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>  
            <div class="navbar-header">
              <a class="navbar-brand" href="adminHomepage.php">Programming Platform</a>
            </div>
        <?php } else { ?>
          <div class="navbar-header">
              <a class="navbar-brand" href="userHomepage.php">Programming Platform</a>
            </div>
        <?php }  ?>

        <ul class="nav navbar-nav">
            <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>  
                <li class="active"><a href="adminHomepage.php">Home</a></li>
            <?php } else { ?>
                <li class="active"><a href="userHomepage.php">Home</a></li>
            <?php }  ?>

          <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Contest <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="showContestList/showListOfContestsForAdmin.php">Show Contest</a></li>
              <li><a href="setContest/contestInputPage.php">Set new contest</a></li>
              <li><a href="modifyContest/modifyContest.php">Edit contest</a></li>
              <li><a href="deleteContest/deleteAContest.php">Delete contest</a></li>
            </ul>
          </li>
            <li><a href="showContestList/showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
          <?php } else { ?>
          <li><a href="showContestList/showListOfContestsForUser.php">Contests</a></li>
            <li><a href="showContestList/showUpcomingContestListForUser.php">Upcoming Contests</a></li>
          <?php }  ?>

        <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'user') { ?>
            <li><a href="submitAndRunCode/showSubmissionList.php">Submissions</a></li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="profile/showProfile.php">Profile</a></li>
                  <li><a href="profile/showSubmissionListForAUser.php">My Submissions</a></li>
                </ul>
              </li>
        <?php } else { ?>
            <li><a href="profile/showProfile.php">Profile</a></li>
        <?php }  ?>
          
        </ul>


        <?php if(!isset($_SESSION['userName'])) { ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
        <?php } else { ?>
          <ul class="nav navbar-nav navbar-right">
          <li><a href="profile/showProfile.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['userName'] ?></a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
        <?php }  ?>

      </div>
    </nav>



	 <div class="container">
	  <h3>ERROR: You are not authenticated to this page</h3>
	</div>

</body>
</html>

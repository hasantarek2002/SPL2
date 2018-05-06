<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Homepage</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
</head>

<body>
    <nav class="navbar navbar-inverse ">
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
              <li><a href="setContest/contestInputPage.php">set new contest</a></li>
              <li><a href="modifyContest/modifyContest.php">Edit contest</a></li>
              <li><a href="deleteContest/deleteAContest.php">Delete contest</a></li>
            </ul>
          </li>
            <li><a href="showContestList/showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
          <?php } else { ?>
          <li><a href="showContestList/showListOfContestsForUser.php">contests</a></li>
            <li><a href="showContestList/showUpcomingContestListForUser.php">Upcoming Contests</a></li>
          <?php }  ?>
            
            <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'user') { ?>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="profile/showProfile.php">Profile</a></li>
                  <li><a href="profile/showSubmissionListForAUser.php">Submissions</a></li>
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
    
    <?php
	 
	 if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'user') ){
	 	header('location:error.php');
	 }
	?>

	  <div class="container">
      <div class="row">
        <p>An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.</p>
        <p>An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.An external style sheet can be written in any text editor. The file should not contain any html tags. The style sheet file must be saved with a .css extension.</p>
      </div>
      <br><br>

      <div class="row">
          <div class="col-md-4 col-md-offset-4  imageHeight">
            <div class="hovereffect">
              <img src="image/sir.jpg" class="img-responsive"  alt="Image of Dr. Mohammad Shoyaib" width="300px" height="300px" > 
              <div class="overlay">
                      <h2>Dr. Mohammad Shoyaib </h2>
              <p>
                Professor<br>
                Institute of Information Technology<br>
                University Of Dhaka
              </p>
                </div>
          </div>
        </div>

        </div>
        <br><br>

        <div class="row">
          <div class="col-md-4  imageHeight">
            <div class="hovereffect">
              <img src="image/hasan.jpg" class="img-responsive"  alt="Image of Hasan" width="300px" height="300px" > 
                <div class="overlay">
                        <h2>MD. Hasan Tarek </h2>
                <p>
                  BSSE 8th Batch<br>
                    Institute of Information Technology<br>
                    University of Dhaka 
                </p>
                  </div>
            </div>
          </div>
          <div class="col-md-4 col-md-offset-4 imageHeight">
            <div class="hovereffect">
              <img src="image/shihab.jpg" class="img-responsive"  alt="Image of Hasan" width="300px" height="300px" > 
                <div class="overlay">
                        <h2>Shayakh Shihab Uddin </h2>
                <p>
                  BSSE 8th Batch<br>
                    Institute of Information Technology<br>
                    University of Dhaka
                </p>
                  </div>
            </div>
          </div>

      </div>
      <br><br><br><br>


      <div class="row">
        <center>copyright &copy; 2018 By Hasan and Shihab </center>
      </div>
    </div>

</body>
</html>

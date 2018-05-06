<?php
	session_start();
    if(!isset($_SESSION['userName']) ){
        $path="../error.php";
	 	header('location:'.$path);
	 }
?>

<?php  
 include_once ("../connection.php");
 $userName=$_SESSION['userName'];
 $sql = "SELECT * FROM users WHERE userName='$userName'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
 
 ?>

<?php 
    if(isset($_REQUEST['update']) ){
        $password=$_REQUEST['password'];
        $institute=$_REQUEST['institute'];
        $recoveryPin=$_REQUEST['recoveryPin'];
        $password=md5($password);
        $recoveryPin=md5($recoveryPin);
        
        $sql2 = "UPDATE users SET password='$password', recoveryPin='$recoveryPin', institute='$institute' WHERE userName='$userName' ";
        
        if(mysqli_query($conn, $sql2)){
            header('location:showProfile.php');
        }else{
            $path="../error.php";
	 	    header('location:'.$path);
        }

        
    }
?>

 <!DOCTYPE html>  
 <html> 
      <head>
      <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../DataTables/datatables.min.js"></script>

        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <title>User Profile</title>
        <style>
            .userInformation{
                font-size: 30px;
                color: black;
            }  
          
        </style>
    </head>

      <body> 
          <nav class="navbar navbar-inverse ">
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
                      <li><a href="../setContest/contestInputPage.php">set new contest</a></li>
                      <li><a href="../modifyContest/modifyContest.php">Edit contest</a></li>
                      <li><a href="../deleteContest/deleteAContest.php">Delete contest</a></li>
                    </ul>
                  </li>
                    <li><a href="../showContestList/showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
                  <?php } else { ?>
                  <li><a href="../showContestList/showListOfContestsForUser.php">contests</a></li>
                    <li><a href="../showContestList/showUpcomingContestListForUser.php">Upcoming Contests</a></li>
                  <?php }  ?>


                 <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'user') { ?>
                  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="showProfile.php">Profile</a></li>
                      <li><a href="showSubmissionListForAUser.php">Submissions</a></li>
                    </ul>
                  </li>
                <?php } else { ?>
                <li><a href="showProfile.php">Profile</a></li>
                <?php }  ?>
                    
                </ul>


                <?php if(!isset($_SESSION['userName'])) { ?>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="../signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                  <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <?php } else { ?>
                  <ul class="nav navbar-nav navbar-right">
                  <li><a href="showProfile.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['userName'] ?></a></li>
                  <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                <?php }  ?>

            </div>
        </nav>
          
          
          
           <br />
           <div class="container">  
                <h2 align="center">Profile</h2>  
                <br />
               <div class="row userInformation">
                    <div class="col-sm-4"> User Name : </div>
                    <div class="col-sm-8 "> <?php echo $row['userName']; ?> </div>
                </div>
               <div class="row userInformation">
                    <div class="col-sm-4"> Institute : </div>
                    <div class="col-sm-8 "> <?php echo $row['institute']; ?> </div>
                </div>
               <br>
               <div class="row">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Modify Profile</button>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Modify Profile</h4>
                        </div>
                        <div class="modal-body">
                          <form name="profileModificationForm" onsubmit="return validateUserData()" method="post">
                            <div class="form-group">
                              <label for="contest-name">Institute:</label>
                              <input type="text" class="form-control" name="institute" value="<?php echo $row['institute']; ?>"  maxlength="50" required>
                            </div>
                              
                              <div class="form-group">
                              <label for="contest-name">Recovery Pin:</label>
                              <input type="text" class="form-control" name="recoveryPin" value="" maxlength="50" required>
                            <span id="recoveryPin-alert" class="text-danger"> </span>
                            </div>
                              
                            <div class="form-group">
                              <label for="contest-name">Password:</label>
                              <input type="password" class="form-control" name="password" value=""  maxlength="50" required>
                            <span id="password-alert" class="text-danger"> </span>
                            </div>
                              
                              <div class="form-group">
                              <label for="contest-name">Retype Password:</label>
                              <input type="password" class="form-control" name="confirmPassword"  value="" maxlength="50" required>
                            <span id="confirmPassword-alert" class="text-danger"> </span>
                            </div>

                            <input type="submit" class="btn btn-success" value="update" name="update"> 
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              <script type="text/javascript" src="../js/showProfile.js"></script>
                 
           </div>  
      </body>  
 </html>


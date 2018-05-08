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
$userImage=$row['userImage'];

?>

<?php 
if(isset($_REQUEST['update']) ){
    $password=$_REQUEST['password'];
    $institute=$_REQUEST['institute'];
    $recoveryPin=$_REQUEST['recoveryPin'];
    $fullName=$_REQUEST['fullName'];
    $password=md5($password);
    $recoveryPin=md5($recoveryPin);

    $sql2 = "UPDATE users SET password='$password', recoveryPin='$recoveryPin', institute='$institute', fullName='$fullName' WHERE userName='$userName' ";

    if(mysqli_query($conn, $sql2)){
        header('location:showProfile.php');
    }else{
        $path="../error.php";
        header('location:'.$path);
    }
}
$allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
$extension = @end(explode(".", $_FILES["file"]["name"]));

if(isset($_REQUEST['submit'])){
    $fileType = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
   if($_FILES["file"]["size"] > 500000){
     echo "<script type=\"text/javascript\">
            alert('Image should be less than 500 KB');
            </script>
        ";
       //echo "File Size Limit Crossed 500 KB Use Picture Size less than 200 KB";
   } 
else if ((($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 200000)
    && in_array($extension, $allowedExts))
  {
    if ($fileType=="jpg") { 
      $newfilename= $_SESSION['userName'].'.jpg';
      @rename(basename($_FILES["file"]["name"]), $newfilename);
    }else if ($fileType=="png") {
      $newfilename= $_SESSION['userName'].'.png';
      @rename(basename($_FILES["file"]["name"]), $newfilename);
    }else if ($fileType=="jpeg") {
      $newfilename= $_SESSION['userName'].'.jpeg';
      @rename(basename($_FILES["file"]["name"]), $newfilename);
    }
    move_uploaded_file($_FILES["file"]["tmp_name"], "../imageUpload/" . $newfilename);
    
   $q = mysqli_query($conn,"UPDATE users SET userImage = '".$newfilename."' WHERE userName = '".$_SESSION['userName']."'");
    if($q){
        header('location:showProfile.php');
    }else{
        $path="../error.php";
        header('location:'.$path);
    }
  } 
   else{
       echo "<script type=\"text/javascript\">
            alert('Image should be of jpg or png or jpeg type');
            </script>
        ";
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
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../DataTables/datatables.min.js"></script>

        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <title>User Profile</title>
        <style>
            .userInformation{
                font-size: 20px;
                color: black;
            }  

        </style>
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
                            <li><a href="showProfile.php">Profile</a></li>
                            <li><a href="showSubmissionListForAUser.php">My Submissions</a></li>
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
            <div class="row">
                <div class="col-sm-4">
                    <div>
                        <?php
                        if($row['userImage'] == ""){
                            echo "<img width='150' height='150' src='../imageUpload/default.jpeg' alt='Profile Picture'>";
                        }else {
                            echo "<img width='150' height='150' src='../imageUpload/".$row['userImage']."' alt='Profile Pic'>";
                        }
                        ?>
                    </div>
                    <br/>
                    <div>
                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myImageModal">Change</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myImageModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Change Profile Picture</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form name="imageForm" method="post" enctype="multipart/form-data" onsubmit="return imageValidation()">
                                            <input type="file" name="file" id="imageFleInput">
                                            <input type="submit" class="btn btn-success btn-sm" name="submit" value="Change Image">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="../js/imageValidation.js"></script>


                </div>

                <div class="col-sm-8">
                    <div class="row userInformation">
                        <div class="col-sm-4"> User Name : </div>
                        <div class="col-sm-8 "> <?php echo $row['userName']; ?> </div>
                    </div>
                    <div class="row userInformation">
                        <div class="col-sm-4"> Full Name : </div>
                        <div class="col-sm-8 "> <?php echo $row['fullName']; ?> </div>
                    </div>
                    <div class="row userInformation">
                        <div class="col-sm-4"> Institute : </div>
                        <div class="col-sm-8 "> <?php echo $row['institute']; ?> </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">Modify Profile</button>

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
                                                <label for="contest-name">Full Name:</label>
                                                <input type="text" class="form-control" name="fullName" value="<?php echo $row['fullName']; ?>"  maxlength="50" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="contest-name">Recovery Pin:</label>
                                                <input type="password" class="form-control" name="recoveryPin" value="" maxlength="50" required>
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

                                            <input type="submit" class="btn btn-success" value="Update" name="update"> 
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <script type="text/javascript" src="../js/showProfile.js"></script>


                </div>
            </div>

        </div>  
    </body>  
</html>


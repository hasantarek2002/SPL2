<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'user') ){
        $path="../error.php";
	 	header('location:'.$path);
	 }
?>


<?php  
 include_once ("../connection.php");
$problemId = isset($_GET['problemId'])? $_GET['problemId'] : "";
$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
//echo "contest id".$contestId.'<br>';
$sql="SELECT * FROM problem WHERE problemId=$problemId ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
 ?>  
 <!DOCTYPE html> 
 <html> 
      <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../DataTables/datatables.min.js"></script>

        <script src="../bootstrap/js/bootstrap.min.js"></script>

      <script type="text/javascript">
        function validateForm(){
          //var submittedCode=document.getElemenyById("submittedCode").value;
          var submittedCode=document.forms['codeForm']['code'].value;
          if(submittedCode == ""){
            alert("submit your code first");
            return false;
          }

          
          return true;
        } 
      </script>
    <!--<style>
        body{
            background-color: gray;
            
        }
        .navbar {
        color: red;
        background-color: darkslateblue;
        }
        .dropdown-menu{
            color: red;
            background-color: blue;
        }
        #language{
            background-color: lightcyan;
        }
    </style>-->

      <title>problem submission</title>
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
                    <li><a href="showSubmissionList.php">Submissions</a></li>
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
           <br />
          

           <div class="container">
            <div class="row">
                <center>
                    <h3>Problem name : <?php echo $row['problemName']; ?> </h3>
                    <h4>Timelimit : <?php echo $row['timeLimit']; ?> second</h4>
                    <br /> 
                    
                </center>
               
               
             </div>
             <div class="row">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src='../setContest/viewPDFFileUsingTable.php?id= "<?php echo $problemId; ?>"' height="400" width="1080"></iframe>
                </div>
                
              </div>
              <br><br><br>

            <form name="codeForm"  action='compileCode.php?problemId=<?php echo $problemId."&contestId=$contestId"; ?>' onsubmit="return validateForm()" method="post">
              <div class="form-group">
                <div class="col-sm-2">          
                  <select name="selectedLanguage" class="form-control" id="language">
                  <option value="C" selected>C</option>
                  <option value="C++" >C++ </option>
                </select>
                </div>
                <div class="col-sm-10">         
                  <textarea class="form-control" rows="12" name="code" id="submittedCode" required>/* Submit your code here */</textarea>
                </div>

              </div>
               <br />

              <div class="form-group">        
                <div class="col-sm-offset-6">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
      </body>  

 </html>
<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
?>


<?php  
 include_once ("../connection.php");
$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";

$sql="SELECT * FROM problem WHERE contestId=$contestId ";
$result = mysqli_query($conn, $sql);
 
 ?>  
 <!DOCTYPE html>  
 <html> 
      <head>
      <title>problem input page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="../bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../DataTables/datatables.min.js"></script>

        <script src="../bootstrap/js/bootstrap.min.js"></script>

      <title>Problems List</title>
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
                  <li><a href="showListOfContestsForAdmin.php">Show Contest</a></li>
                  <li><a href="../setContest/contestInputPage.php">set new contest</a></li>
                  <li><a href="../modifyContest/modifyContest.php">Edit contest</a></li>
                  <li><a href="../deleteContest/deleteAContest.php">Delete contest</a></li>
                </ul>
              </li>
              <?php } else { ?>
              <li><a href="showListOfContestsForUser.php">contests</a></li>
              <?php }  ?>


              <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'user') { ?>
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="../profile/showProfile.php">Profile</a></li>
                          <li><a href="../profile/showSubmissionListForAUser.php">Submissions</a></li>
                        </ul>
                      </li>
                    <?php } else { ?>
                    <li><a href="../profile/showProfile.php">Profile</a></li>
                    <?php }  ?>
            </ul>


            <?php if(!isset($_SESSION['userName'])) { ?>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
                <h3 align="center">Problems List</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="problemData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Id</td>  
                                    <td>Name</td>
                                   <td>Time Limit</td>
                               </tr>  
                          </thead>  
                          <?php
                          while($row = mysqli_fetch_array($result))  
                          {  

                           echo '<tr>
                                <td>'.$row["problemId"].'</td>
                                <td>';
                                echo "<a href='../setContest/viewPDFFileUsingTable.php?id=".$row['problemId']."' target='_blank'>".$row['problemName']."</a>".'</td><td>';
                              echo $row['timeLimit'].'</td></tr>';
                                
                            
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#problemData').DataTable();  
 });  
 </script>  
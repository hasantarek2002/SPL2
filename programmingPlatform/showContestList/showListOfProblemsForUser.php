<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'user') ){
        $path="../error.php";
	 	header('location:'.$path);
    }

include_once ("../connection.php");
$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
///store contest id in a session to show rank used in showRank.php file
$_SESSION['contestId']=$contestId;

$sql="SELECT * FROM problem WHERE contestId=$contestId ";
$result = mysqli_query($conn, $sql);

//this one for timer
$sql2="select * from contest where contestId=$contestId ";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);

$initialTime=$row2['startingTime'];
$duration = $row2['duration'];


$splitDate = explode(":",$duration);
$hour_to_add = $splitDate[0];
$minutes_to_add = $splitDate[1];
$second_to_add = $splitDate[2];
//echo "hour is ".$splitDate[0].'<br>';
//echo "minuite  is ".$splitDate[1].'<br>';
//echo "second is ".$splitDate[2].'<br>';
$time = new DateTime($initialTime);
$time->add(new DateInterval('PT' . $hour_to_add . 'H'.$minutes_to_add.'M'.$second_to_add.'S'));
$endTime = $time->format('Y-m-d H:i:s');

//echo "Initial date is ".$initialTime.'<br>';
//echo "duration  is ".$duration.'<br>';
//echo 'end datetime  is '.$endTime.'<br>';
/*
$tt=strtotime($endTime);
echo (date("Y-m-d H:i:s",$tt)) .'<br>';
*/
$_SESSION['endTime']=$endTime;

date_default_timezone_set("Asia/Dhaka");
$startTimeInSecond=strtotime($initialTime);
$currentTimeInSecond=time();
$endTimeInSecond=strtotime($endTime);

//echo "Initial time(s) is ".$startTimeInSecond.'<br>';
//echo 'current time(s) is '.time().'<br>';
//echo 'end time(s)  is '.$endTimeInSecond.'<br>';


if( $currentTimeInSecond < $startTimeInSecond){
    header('location:contestMessage.php');
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
          
       <link rel="stylesheet" type="text/css" href="../css/timer.css">

      <title>problems List</title>
    </head>

      <body> 
          <nav class="navbar">
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
                      <li><a href="../setContest/contestInputPage.php">Set new contest</a></li>
                      <li><a href="../modifyContest/modifyContest.php">Edit contest</a></li>
                      <li><a href="../deleteContest/deleteAContest.php">Delete contest</a></li>
                    </ul>   
                  </li>
                    <li><a href="showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
                  <?php } else { ?>
                  <li><a href="showListOfContestsForUser.php">Contests</a></li>
                    <li><a href="showUpcomingContestListForUser.php">Upcoming Contests</a></li>
                  <?php }  ?>
                    
                    <?php 
                    if($currentTimeInSecond >= $startTimeInSecond ){ ?>
                    <li><a href="../submitAndRunCode/showRank.php">Rank</a></li>
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
           <br /><br /> 
          
          <p id="demo"></p>

        <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?php echo $_SESSION['endTime'] ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "CONTEST FINISHED";
            }
        }, 1000);        
        </script>
          
           <div class="container">  
                <h3 align="center">Problems List</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="problemData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Id</td>  
                                    <td>Name</td>
                               </tr>  
                          </thead>  
                          <?php
                          while($row = mysqli_fetch_array($result))  
                          {  

                            echo '<tr>
                                <td>'.$row["problemId"].'</td>
                                <td>';
                                echo "<a href='../submitAndRunCode/problemSubmitPage.php?problemId=".$row['problemId']."&contestId=$contestId"."' target='_self'>".$row['problemName']."</a>".'</td></tr>';
                                
                            
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
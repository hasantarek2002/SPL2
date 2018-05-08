<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	$path="../error.php";
	 	header('location:'.$path);
	 }
?>

<?php
include_once "../connection.php";
?>

<!DOCTYPE html>
<html>

	<head>
	    <title>problem input page</title>
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
              <li><a href="contestInputPage.php">Set new contest</a></li>
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

    
    
<?php
function showTable() {
$cId=$_SESSION['contestId'];
 //echo $cId;
include "../connection.php";
$sql2 = "SELECT * FROM problem where contestId='$cId' ";
$result = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result) > 0) {
?>
    
                <div class="container">  
                <h3 align="center">Contests</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="problemData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>problem id</td>  
                                    <td>contest id</td>
                                    <td>problem name</td>  
                                    <td>Time Limit</td>  
                                    <td>Question file</td>
                                    <td>Delete</td>
                               </tr>  
                          </thead>  
<?php
while($row = mysqli_fetch_assoc($result))  
{  

echo '<tr>
    <td>'.$row["problemId"].'</td>
    <td>'.$row["contestId"].'</td>
    <td>'.$row["problemName"].'</td>
    <td>'.$row["timeLimit"].'</td>
    <td>';
echo "<a href='viewPDFFileUsingTable.php?id=".$row['problemId']."' target='_blank'>".$row['questionFile']."</a>".'</td><td>';
echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='setProblem.php?delId=".$row['problemId']."'>"."Delete"."</a>".'</td></tr>';
}
?>
                     </table>
                </div>  
           </div>
<?php } } ?>
<?php
showTable();
if(isset($_REQUEST["delId"])){
$delId=$_REQUEST["delId"];

$sql4 = "SELECT * FROM problem where problemId='$delId' ";
$result2=mysqli_query($conn, $sql4);

if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
    $questionFileToDelete=$row2['questionFile'];
    $inputFileToDelete=$row2['inputFile'];
    $solutionFileToDelete=$row2['solutionFile'];

    unlink($questionFileToDelete);
    unlink($inputFileToDelete);
    unlink($solutionFileToDelete); 

    $sql3 = "DELETE FROM problem where problemId='$delId' ";
    mysqli_query($conn, $sql3);
}
header('location:setProblem.php');
}
?>
<?php
if(isset($_POST["submit"])) {
    $contestId=$_SESSION['contestId'];
    $problemName=$_POST['problemName'];
    $timeLimit=$_POST['timeLimit'];

    $target_dir = "uploads/";
    $questionFileType = strtolower(pathinfo(basename($_FILES["questionFile"]["name"]),PATHINFO_EXTENSION));
    $inputFileType = strtolower(pathinfo(basename($_FILES["inputFile"]["name"]),PATHINFO_EXTENSION));
    $solutionFileType = strtolower(pathinfo(basename($_FILES["solutionFile"]["name"]),PATHINFO_EXTENSION));


    $sql5="SELECT problemId FROM problem ORDER BY problemId DESC";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $lastId = $row5['problemId']+1;
    $renameFile=strval($lastId);

    $uploadOk = 1;

    if($questionFileType == "pdf"){
        //$renameFile=strval($lastId);
        $f= 'q'.$renameFile.'.pdf';
        @rename(basename($_FILES["questionFile"]["name"]), $f);
        $questionTargetFile = $target_dir . $f;
    }else{
        $uploadOk = 0;
    }
    if($inputFileType == "txt"){	
        $f= 'i'.$renameFile.'.txt';
        @rename(basename($_FILES["inputFile"]["name"]), $f);
        $inputTargetFile = $target_dir . $f;
    }else{
        $uploadOk = 0;
    }
    if($solutionFileType == "txt"){	
        $f= 's'.$renameFile.'.txt';
        @rename(basename($_FILES["solutionFile"]["name"]), $f);
        $solutionTargetFile = $target_dir . $f;
    }else{
        $uploadOk = 0;
    }


    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    /*
    echo 'Base question file name is '.basename($_FILES["questionFile"]["name"]).'<br>';
    echo 'uploaded question file is '.$questionTargetFile.'<br>';
    echo 'uploaded question file type is '.$questionFileType.'<br>';

    echo 'Base input file name is '.basename($_FILES["inputFile"]["name"]).'<br>';
    echo 'uploaded input file is '.$inputTargetFile.'<br>';
    echo 'uploaded input file type is '.$inputFileType.'<br>';

    echo 'Base output file name is '.basename($_FILES["solutionFile"]["name"]).'<br>';
    echo 'uploaded output file is '.$solutionTargetFile.'<br>';
    echo 'uploaded output file type is '.$solutionFileType.'<br>';
    */


    // Check if file already exists
    if (file_exists($questionTargetFile)) {
        //echo "Sorry, question file already exists.";
        $uploadOk = 0;
    }
    if (file_exists($inputTargetFile)) {
        //echo "Sorry, input file already exists.";
        $uploadOk = 0;
    }
    if (file_exists($solutionTargetFile)) {
        //echo "Sorry, output file already exists.";
        $uploadOk = 0;
    }

    // Check file size 1000*1000
    if ($_FILES["questionFile"]["size"] > 5000000) {
        //echo "Sorry, your question file is too large.(max 5MB)";
        $uploadOk = 0;
    }
    if ($_FILES["inputFile"]["size"] > 5000000) {
        //echo "Sorry, your input file is too large.(max 5MB)";
        $uploadOk = 0;
    }
    if ($_FILES["solutionFile"]["size"] > 5000000) {
        //echo "Sorry, your output file is too large.(max 5MB)";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($questionFileType != "pdf" && $inputFileType != "txt" && $solutionFileType != "txt" ) {
        //echo "Sorry, question file must be pdf and input , output file must be in text format";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
        //echo "temporary file name is :: ".$_FILES["questionFile"]["tmp_name"].'<br>';
        if (move_uploaded_file($_FILES["questionFile"]["tmp_name"], $questionTargetFile) && move_uploaded_file($_FILES["inputFile"]["tmp_name"], $inputTargetFile) && move_uploaded_file($_FILES["solutionFile"]["tmp_name"], $solutionTargetFile)) {

            $sql = "INSERT INTO problem (contestId, problemName, timeLimit, questionFile, inputFile, solutionFile) VALUES ('$contestId','$problemName', '$timeLimit', '$questionTargetFile', '$inputTargetFile', '$solutionTargetFile')";
            //echo "The question file ".$questionTargetFile . " has been uploaded.".'<br>';
            //echo "The input file ".$inputTargetFile . " has been uploaded.".'<br>';
            //echo "The output file ".$solutionTargetFile . " has been uploaded.".'<br>';

            if(mysqli_query($conn, $sql)){
                //echo "file reference is added to database".'<br>';
            }
            else{
                //echo "file reference is not added to database".'<br>';
            }

        }
         else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
    header('location:setProblem.php');
    //showTable();	    
}


if(isset($_POST["finish"])) {
    $contestId=$_SESSION['contestId'];
    $problemName=$_POST['problemName'];
    $timeLimit=$_POST['timeLimit'];

    $target_dir = "uploads/";
    $questionFileType = strtolower(pathinfo(basename($_FILES["questionFile"]["name"]),PATHINFO_EXTENSION));
    $inputFileType = strtolower(pathinfo(basename($_FILES["inputFile"]["name"]),PATHINFO_EXTENSION));
    $solutionFileType = strtolower(pathinfo(basename($_FILES["solutionFile"]["name"]),PATHINFO_EXTENSION));


    $sql5="SELECT problemId FROM problem ORDER BY problemId DESC";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $lastId = $row5['problemId']+1;
    $renameFile=strval($lastId);

    $uploadOk = 1;

    if($questionFileType == "pdf"){
        //$renameFile=strval($lastId);
        $f= 'q'.$renameFile.'.pdf';
        @rename(basename($_FILES["questionFile"]["name"]), $f);
        $questionTargetFile = $target_dir . $f;
    }else{
        $uploadOk = 0;
    }
    if($inputFileType == "txt"){	
        $f= 'i'.$renameFile.'.txt';
        @rename(basename($_FILES["inputFile"]["name"]), $f);
        $inputTargetFile = $target_dir . $f;
    }else{
        $uploadOk = 0;
    }
    if($solutionFileType == "txt"){	
        $f= 's'.$renameFile.'.txt';
        @rename(basename($_FILES["solutionFile"]["name"]), $f);
        $solutionTargetFile = $target_dir . $f;
    }else{
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($questionTargetFile)) {
        //echo "Sorry, question file already exists.";
        $uploadOk = 0;
    }
    if (file_exists($inputTargetFile)) {
        //echo "Sorry, input file already exists.";
        $uploadOk = 0;
    }
    if (file_exists($solutionTargetFile)) {
        //echo "Sorry, output file already exists.";
        $uploadOk = 0;
    }

    // Check file size 1000*1000
    if ($_FILES["questionFile"]["size"] > 5000000) {
        //echo "Sorry, your question file is too large.(max 5MB)";
        $uploadOk = 0;
    }
    if ($_FILES["inputFile"]["size"] > 5000000) {
        //echo "Sorry, your input file is too large.(max 5MB)";
        $uploadOk = 0;
    }
    if ($_FILES["solutionFile"]["size"] > 5000000) {
        //echo "Sorry, your output file is too large.(max 5MB)";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($questionFileType != "pdf" && $inputFileType != "txt" && $solutionFileType != "txt" ) {
        //echo "Sorry, question file must be pdf and input , output file must be in text format";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
        //echo "temporary file name is :: ".$_FILES["questionFile"]["tmp_name"].'<br>';
        if (move_uploaded_file($_FILES["questionFile"]["tmp_name"], $questionTargetFile) && move_uploaded_file($_FILES["inputFile"]["tmp_name"], $inputTargetFile) && move_uploaded_file($_FILES["solutionFile"]["tmp_name"], $solutionTargetFile)) {

            $sql = "INSERT INTO problem (contestId, problemName, timeLimit, questionFile, inputFile, solutionFile) VALUES ('$contestId','$problemName', '$timeLimit', '$questionTargetFile', '$inputTargetFile', '$solutionTargetFile')";
            //echo "The question file ".$questionTargetFile . " has been uploaded.".'<br>';
            //echo "The input file ".$inputTargetFile . " has been uploaded.".'<br>';
           // echo "The output file ".$solutionTargetFile . " has been uploaded.".'<br>';

            if(mysqli_query($conn, $sql)){
                //echo "file reference is added to database".'<br>';
                unset($_SESSION['contestId']);
            }
            else{
                //echo "file reference is not added to database".'<br>';
            }



        }
         else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
header("location:showListOfProblems.php?contestId= '$contestId' ");
}
?>
<script>
		function getExtension(filename) {
		    var parts = filename.split('.');
		    return parts[parts.length - 1];
		}
		function validateExtensionOfFile(){

			var problemName=document.forms["fileUpload"]["problemName"].value;
			var questionFile=document.forms["fileUpload"]["questionFile"].value;
			var inputFile=document.forms["fileUpload"]["inputFile"].value;
			var solutionFile=document.forms["fileUpload"]["solutionFile"].value;

			var questionFileExtension=getExtension(questionFile);
			var inputFileExtension=getExtension(inputFile);
			var solutionFileExtension=getExtension(solutionFile);

			if(questionFileExtension != "pdf"){
				alert("qustion file must be pdf");
				return false;
			}
			if(inputFileExtension != "txt"){
				alert("input file must be text type.");
				return false;
			}
			if(solutionFileExtension != "txt"){
				alert("solutuon file must be text type.");
				return false;
			}
			return true;
			
		}
	</script>

    <div class="container">
	  <h2>problem Input</h2>
	  <form name="fileUpload" onsubmit="return validateExtensionOfFile()" method="post" enctype="multipart/form-data">
          
	    <div class="form-group">
	      <label for="problem-name">problem name</label>
	      <input type="text" class="form-control" placeholder="Enter problem name" name="problemName" maxlength="50" required>
	    </div>
          
	    <div class="form-group">
	      <label for="time-limit">Time limit</label>
	      <input type="number" class="form-control" name="timeLimit" value="2" min="1" max="5" required>
	    </div>
          
        <div class="form-group">
	      <label for="question-file">select question file(pdf) to Upload</label>
	      <input type="file" class="form-control" name="questionFile" required>
	    </div> 
        <div class="form-group">
	      <label for="input-file">select input file(txt) to Upload</label>
	      <input type="file" class="form-control" name="inputFile" required>
	    </div> 
        <div class="form-group">
	      <label for="solution-file">select solution file(txt) to Upload</label>
	      <input type="file" class="form-control" name="solutionFile" required>
	    </div> 
        
	    
	    <input type="submit" class="btn btn-success" value="Add another problem" name="submit">
          <input type="submit" class="btn btn-success" value="Finish" name="finish"> 
	  </form>
	</div>


</body>
</html>

 <script>  
 $(document).ready(function(){  
      $('#problemData').DataTable();  
 });  
 </script> 
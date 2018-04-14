<?php
	session_start();
?>

<?php
	
	if(isset($_REQUEST['userName']) && isset($_REQUEST['password'])){
		include_once ("connection.php");
		$userName=$_REQUEST['userName'];
		$password=$_REQUEST['password'];
		$sql = "SELECT * FROM users WHERE userName='$userName' and password='$password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		$userType=$row['userType'];
		$rowCount=mysqli_num_rows($result);

		if($rowCount>0){
			$_SESSION['userName']=$_REQUEST['userName'];
			$_SESSION['userType']=$userType;
			if($userType == 'admin'){
				header('location:adminHomepage.php');
			}else{
				header('location:userHomepage.php');
			}
			

			//echo "log in successfull";	
		}
		else{
			echo "not logged in ";
            
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>log in</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
	  <h2>Log in form</h2>
	  <form name="loginForm" method="post">
	    <div class="form-group">
	      <label for="userName">User Name:</label>
	      <input type="text" class="form-control" id="user" placeholder="Enter user name" name="userName" required>
	    </div>
	    <div class="form-group">
	      <label for="pwd">Password:</label>
	      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
	    </div>
	    
	    <button type="submit" class="btn btn-success" name="submit">Log in</button>
	  </form>
	</div>

</body>
</html>
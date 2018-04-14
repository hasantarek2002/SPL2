
<?php
	
	if(isset($_REQUEST['submit']) ){
		include_once ("connection.php");
		$userName=$_REQUEST['userName'];
		$password=$_REQUEST['password'];
		$recoveryPin=$_REQUEST['recoveryPin'];
		
		$sql = "INSERT INTO users (userName, password, recoveryPin, userType) VALUES('$userName', '$password','$recoveryPin', 'user')";

		if(mysqli_query($conn, $sql)){
			echo "data inserted";
		}else{
			echo "data not inserted";
		}

	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>sign up</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
	  <h2>sign up form</h2>
	  <form name="loginForm" method="post">
	    <div class="form-group">
	      <label for="userName">User Name:</label>
	      <input type="text" class="form-control" id="user" placeholder="Enter user name" name="userName" required>
	    </div>
	    <div class="form-group">
	      <label for="pwd">Password:</label>
	      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
	    </div>

	    <div class="form-group">
	      <label for="pwd">Re-enter Password:</label>
	      <input type="password" class="form-control" id="pwd2" placeholder="Retype password" name="reTypedPassword" required>
	    </div>
	    <div class="form-group">
	      <label for="pin">Enter Recovery pin:</label>
	      <input type="number" class="form-control" id="pin" maxlength="4" 
	      placeholder="Enter pin" name="recoveryPin" required>
	    </div>
	    
	    <button type="submit" class="btn btn-success" name="submit">Sign up</button>
	  </form>
	</div>

</body>
</html>
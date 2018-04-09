<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Homepage</title>
  <?php
  	include "header.php";
  ?>
</head>

<body>
	<?php
	  include "navBar.php";
	 
	 if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'admin') ){
	 	header('location:error.php');
	 }
	?>



	 <div class="container">
	  <h3>This is admin Homepage</h3>
	</div>

</body>
</html>

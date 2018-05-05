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
 	session_unset();
	session_reset();
	// destroy the session
	session_destroy();
	header('location:index.php');
	//echo "All session variables are now removed, and the session is destroyed."
	
	?>


</body>
</html>

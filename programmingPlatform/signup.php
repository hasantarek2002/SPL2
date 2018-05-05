<?php
    session_start();
?>

<?php
    include_once ("connection.php");
    if(isset($_REQUEST['signup'])){
        $userName= $_REQUEST['userName'];
        $password=$_REQUEST['password'];
        $recoveryPin=$_REQUEST['recoveryPin'];
        $institute=$_REQUEST['institute'];

        $sql2 = "SELECT * FROM users WHERE userName='$userName' ";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        $rowCount=mysqli_num_rows($result2);
        if($rowCount == 0){
            //$password=base64_encode($password);
            //$recoveryPin=base64_encode($recoveryPin);
            $password=md5($password);
            $recoveryPin=md5($recoveryPin);

            $sql = "INSERT INTO users (userName, password, recoveryPin, userType,institute) VALUES('$userName', '$password','$recoveryPin', 'user', '$institute')";
            //$sql= "insert into users (username, password, recoveryPin) values('$username','$password', '$recovery_pin' )";
            // mysqli_query($db, $sql);

            if(mysqli_query($conn, $sql)){
                    header('location:index.php');
            }else{
                header('location:databaseErrorMessage.php');
            }
        }else {
            $_SESSION['msg']="User name already exist. Please, Try again";
        }
           
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/authentication.css">

        <script src="bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="header">
    <div class="row">
      <div class="judge-name">
        Programming Platform 

      </div>
    </div>
  </div>

  <br>
  <br>
  <br>
  <br>
       
<div class="row">
<div class="col-sm-1">
</div>
<div class="col-sm-9">
 <center>
  <div class="form-group">

   <div class="loginFormDesign">
    <h2 style="">Sign Up</h2><br><br>

    <form name="signupForm" method="POST" onsubmit="return userValidation()">

      <div class="form-group">
        <label for="username">Username</label> 
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input class="form-control" type="text" id="userName" name="userName" placeholder="Enter Username"  autocomplete="off" required>
          <span id="username-alert" class="text-danger">
            <?php 
            if (isset($_SESSION['msg'])) {
              echo $_SESSION['msg']; 
            } 
            unset($_SESSION['msg']); 
            ?> 

          </span>
        </div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>  
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input class="form-control" type="password" id="password" name="password" placeholder="Enter Password" autocomplete="off" required>
          <span id="password-alert" class="text-danger"> </span>

        </div>
      </div>

      <div class="form-group">
        <label for="password">Confirm Password</label>  
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter Password" autocomplete="off" required>
          <span id="confirmPassword-alert" class="text-danger"> </span>

        </div>
      </div>

      <div class="form-group">
        <label for="password">Recovey Pin</label>  
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input class="form-control" type="password" id="recoveryPin" name="recoveryPin" placeholder="Enter Recovery Pin" autocomplete="off" required>
          <span id="recoveryPin-alert" class="text-danger"> </span>

        </div>
      </div>

      <div class="form-group">
        <label for="institute">Institute</label>  
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
          <input class="form-control" type="text" id="institute" name="institute" placeholder="Enter Institute" autocomplete="off">
          <span id="password-alert" class="text-danger"> </span>

        </div>
      </div>


      <button type="submit" class="btn btn-success" id="signup" name="signup"> Create Account</button><br><br>

      <br>

      <div style="">
       Already have an account? 
       <a href="index.php">  Sign In  </a>
     </div>


   </form>

 </div>



</div>
</center>
</div>

<div class="col-sm-2"></div>

</div>

<br><br><br><br>

<div class="footer">
<div class="row">
Developed by Shihab & Hasan
</div>
</div>
<script type="text/javascript" src="js/signup.js"></script>

        
     
</body>
</html>
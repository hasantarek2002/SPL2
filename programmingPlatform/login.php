<?php
	session_start();
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
    

    <div>
    </div> <br> <br> <br><br> <br> <br>

      
      <div class="container">
        <form class="well form-horizontal" name="loginForm" onsubmit="return validateLoginForm()" method="post">
            <fieldset>
                <div class="row">
                    <legend><center><h2><b>Login Form</b></h2></center></legend><br>
                </div>
                <div class="row">
                    <div class="col-sm-3"> </div>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="username">Username</label> 
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" id="username" name="userName" placeholder="Username.."  autocomplete="off" required>
                                <span id="userNameAlert" class="text-danger"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"> </div>
                </div>

                <div class="row">
                    <div class="col-sm-3"> </div>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="password">Password</label>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Password.." autocomplete="off" required>
                                <span id="passwordAlert" class="text-danger"> </span>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"> </div>
                </div>
                


                <div class="row">
                    <div class="col-sm-3"> </div>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <center>
                                <div class="text-danger" id="error">
                                    
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-sm-3"> </div>
                </div>


                
            
                 <div class="row">
                     <div class="col-sm-4"> </div>
                    <div class="col-sm-2"> 
                        <div class="form-group">
                             <div class="input-group">
                               <input type="submit" class="btn btn-success" value="Log in" name="submit">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6"> 
                        <a href="signup.php" class="btn btn-primary">Sign up</a>
                     </div>
                </div>
                
                <div class="row">
                     <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <a href="recoverAccount.php">recover account</a>
                    </div>
                </div> 
                
            </fieldset>
          </form>
          
      </div>


    <script src="js/login.js"></script> 
      

  </body>
</html>
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
        }
        else{
?>
    <script type="text/javascript">
        
        document.getElementById("error").innerHTML="user name and password mismatched";
    </script>
<?php

    //echo "not logged in ";
            
        }
    }

?>
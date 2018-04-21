<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Account recovery</title>
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
        <form class="well form-horizontal" name="recoverAccountForm" onsubmit="return validateRecoveryForm()" method="post">
            <fieldset>
                <div class="row">
                    <legend><center><h2><b>Recover Account</b></h2></center></legend><br>
                </div>
                <div class="row">
                    <div class="col-sm-3"> </div>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="username">Username</label> 
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" id="username" name="userName" placeholder="Username.."  autocomplete="off" required>
                                <span id="username-alert" class="text-danger"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"> </div>
                </div>

                <div class="row">
                    <div class="col-sm-3"> </div>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="pin">Recovery Pin</label>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" type="text" id="recoveryPin" name="recoveryPin" placeholder="Recovery Pin number.." autocomplete="off" required>
                                <span id="recoveryPin-alert" class="text-danger"> </span>

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
                     <div class="col-sm-5"> </div>
                    <div class="col-sm-3"> 
                        <div class="form-group">
                             <div class="input-group">
                               <input type="submit" class="btn btn-success" value="recover" name="recover">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4"> 
                       
                     </div>
                </div>
                
            </fieldset>
          </form>
          
      </div>


    <script src="js/recoverAccount.js"></script> 
      

  </body>
</html>
<?php 
    if(isset($_REQUEST['recover']) ){
        include_once ("connection.php");
        $userName=$_REQUEST['userName'];
        $recoveryPin=$_REQUEST['recoveryPin'];
        $sql = "SELECT * FROM users WHERE userName='$userName' and recoveryPin='$recoveryPin'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $rowCount=mysqli_num_rows($result);
        $userType=$row['userType'];

        if($rowCount>0){
            $_SESSION['userName']=$_REQUEST['userName'];
            $_SESSION['userType']=$row['userType'];
            echo "recovery pin is ".$row['recoveryPin'].'<br>';
            /*
            if($userType == 'admin'){
                header('location:adminHomepage.php');
            }else{
                header('location:userHomepage.php');
            } 
            */
        }
        else{
?>
    <script type="text/javascript">
        
        document.getElementById("error").innerHTML="user name and recovery Pin mismatched";
    </script>
<?php
        }
    }
?>
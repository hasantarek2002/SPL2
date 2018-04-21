<?php
    session_start();
    if(!isset($_SESSION['userName']) ){
            header('location:error.php');
    }
?>
<?php
    include_once ("connection.php");

    if(isset($_REQUEST['passwordSubmit']) ){
        
        $userName= $_SESSION['userName'];
        $password=$_REQUEST['password'];
        unset($_SESSION['userName']);
        $sql = "UPDATE users SET password='$password' WHERE userName='$userName' ";
        
        if(mysqli_query($conn, $sql)){
            header('location:login.php');
        }else{
            header('location:error.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>set new password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <script src="bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>

        <br> <br> <br><br> <br> <br>

        <div class="container">
            <div class="row">
                <div class="col-sm-2"> </div>
                <div class="col-sm-8">
                    <form  class="well form-horizontal"  name="setPasswordForm"  method="post" onsubmit="return passwordValidation()">
                        <fieldset>
                            <div class="row">
                                <legend><center><h2><b>Set New Password</b></h2></center></legend><br>
                            </div>

                            <div class="row">
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-8 form-back"> 
                                    <div class="form-group">
                                        <label for="password">Password</label>  
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Enter New Password.." autocomplete="off" required >
                                            <span id="password-alert" class="text-danger"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"> </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-8 form-back"> 
                                    <div class="form-group">
                                        <label for="confirmPasswrod">Confirm Password</label>  
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input class="form-control" type="password" id="confirmPassword" name="confirmPasswrod" placeholder="Confirm Password.." autocomplete="off" required >
                                            <span id="confirmPassword-alert" class="text-danger"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"> </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-5"> </div>
                                <div class="col-sm-6 form-back"> 
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="submit" class="btn btn-success btn-lg" value="Submit" name="passwordSubmit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
                <div class="col-sm-2"> </div>

            </div>
        </div>

        <script type="text/javascript" src="js/setPassword.js"></script>
     
    </body>
</html>
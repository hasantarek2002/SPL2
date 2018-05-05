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
    $password=md5($password);
    $userType=$_SESSION['userType'];
    //unset($_SESSION['userName']);
    $sql = "UPDATE users SET password='$password' WHERE userName='$userName' ";

    if(mysqli_query($conn, $sql)){
        if($userType == "user"){
            header('location:userHomepage.php');
        }else{
            header('location:adminHomepage.php');
        }

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
        <link rel="stylesheet" type="text/css" href="css/authentication.css">

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


        <div class="row ">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-9">
                <center>
                    <div class="form-group">

                        <div class="loginFormDesign background-form">
                            <h2 style="">Set New Password</h2><br><br>

                            <form name="setPasswordForm"  method="POST" onsubmit="return passwordValidation()">

                                <div class="form-group">
                                    <label for="password">Password</label> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter Password"  autocomplete="off" >
                                        <span id="password-alert" class="text-danger"> </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>  
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" placeholder="Enter confirmPassword" autocomplete="off" >
                                        <span id="confirmPassword-alert" class="text-danger"> </span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <div class="text-danger" id="error">

                                        </div>
                                    </center>
                                </div>

                                <input type="submit" class="btn btn-success" name="passwordSubmit" value="Confirm"><br><br>



                                <br>

                                <div style="">
                                    <a href="index.php"> Sign in ? </a>
                                </div>


                            </form>
                        </div>
                    </div>
                </center>
            </div>

            <div class="col-sm-2">

            </div>

        </div><br><br><br><br>

        <script src="js/setPassword.js"></script> 

        <div class="footer">
            <div class="row">
                Developed by Shihab & Hasan
            </div>
        </div>

    </body>
</html>
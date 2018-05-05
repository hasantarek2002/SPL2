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
        <br><br><br><br>

        <div class="row ">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-9">
                <center>
                    <div class="form-group">

                        <div class="loginFormDesign background-form">
                            <h2 style="">Log In</h2><br><br>

                            <form name="loginForm"  method="POST" onsubmit="return validateLoginForm()">

                                <div class="form-group">
                                    <label for="userName">Username</label> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input class="form-control" type="text" id="userName" name="userName" placeholder="Enter Username"  autocomplete="off" required>
                                        <span id="username-alert" class="text-danger"> </span>
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
                                    <center>
                                        <div class="text-danger" id="error">

                                        </div>
                                    </center>
                                </div>

                                <div class="loginLinks">
                                    <a href="recoverAccount.php"> Forgot Password? </a>
                                </div>
                                <input type="submit" class="btn btn-success" name="submit" value="Sign In"><br><br>
                                <br>

                                <div style="">
                                    <a href="signup.php"> Create New Account </a>
                                </div>


                            </form>
                        </div>

                        <!--login javaScript includes-->

                    </div>
                </center>
            </div>

            <div class="col-sm-2"></div>

        </div><br><br><br><br>

        <script src="js/login.js"></script> 

        <div class="footer">
            <div class="row">
                Developed by Shihab & Hasan
            </div>
        </div>


    </body>
</html>
<?php 
if(isset($_REQUEST['userName']) && isset($_REQUEST['password'])){
    include_once ("connection.php");
    $userName=$_REQUEST['userName'];
    $password=$_REQUEST['password'];
    $password=md5($password);
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
    }
}
?>
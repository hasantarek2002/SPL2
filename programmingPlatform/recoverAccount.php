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
                            <h2 style="">Recover Account</h2><br><br>

                            <form name="recoverAccountForm"  method="POST" onsubmit="return validateRecoveryForm()">

                                <div class="form-group">
                                    <label for="userName">Username</label> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input class="form-control" type="text" id="userName" name="userName" placeholder="Enter Username"  autocomplete="off" required >
                                        <span id="username-alert" class="text-danger"> </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="recoveryPin">Recovey pin</label>  
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input class="form-control" type="password" id="recoveryPin" name="recoveryPin" placeholder="Enter Recovey Pin" autocomplete="off" required >
                                        <span id="recoveryPin-alert" class="text-danger"> </span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <div class="text-danger" id="error">

                                        </div>
                                    </center>
                                </div>

                                <input type="submit" class="btn btn-success" name="recover" value="Continue"><br><br>



                                <br>

                                <div style="">
                                    <a href="index.php"> Sign in ? </a>
                                </div>


                            </form>
                        </div>

                        <!--login javaScript includes-->

                    </div>
                </center>
            </div>

            <div class="col-sm-2">

            </div>

        </div><br><br><br><br>

        <script src="js/recoverAccount.js"></script> 

        <div class="footer">
            <div class="row">
                Developed by Shihab & Hasan
            </div>
        </div>


    </body>
</html>
<?php 
if(isset($_REQUEST['recover']) ){
    include_once ("connection.php");
    $userName=$_REQUEST['userName'];
    $recoveryPin=$_REQUEST['recoveryPin'];
    $recoveryPin=md5($recoveryPin);
    $sql = "SELECT * FROM users WHERE userName='$userName' and recoveryPin='$recoveryPin'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $rowCount=mysqli_num_rows($result);
    $userType=$row['userType'];

    if($rowCount>0){
        $_SESSION['userName']=$_REQUEST['userName'];
        $_SESSION['userType']=$row['userType'];
        //echo "recovery pin is ".$row['recoveryPin'].'<br>';
        header('location:setPassword.php');

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
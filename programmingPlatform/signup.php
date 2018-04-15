<?php

include_once ("connection.php");

if(isset($_REQUEST['signup'])){
    $userName= $_REQUEST['userName'];
    $password=$_REQUEST['password'];
    $recoveryPin=$_REQUEST['recoveryPin'];
    $institute=$_REQUEST['institute'];
    
    ///encode
    $password=base64_encode($password);
    $recoveryPin=base64_encode($recoveryPin);
    
    
    

    $sql = "INSERT INTO users (userName, password, recoveryPin, userType,institute) VALUES('$userName', '$password','$recoveryPin', 'user', '$institute')";
    //$sql= "insert into users (username, password, recoveryPin) values('$username','$password', '$recovery_pin' )";
    // mysqli_query($db, $sql);

    if(mysqli_query($conn, $sql)){
            header('location:login.php');
    }else{
        header('location:databaseErrorMessage.php');
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

        <script src="bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>
        

        <br> <br> <br>


        <div class="container">
            <div class="row">
                <div class="col-sm-2"> </div>
                <div class="col-sm-8">

                    <form name="signupForm" class="form-horizontal" method="post" onsubmit="return userValidation()">
                        <fieldset>
                            
                            <div class="row ">
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-8 form-back">
                                    <div class="row signup-header">
                                        <center><h2><b>Registration Form</b></h2></center>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="username">Username</label> 
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input class="form-control" type="text" id="username" name="userName" placeholder="Username.."  autocomplete="off" required >
                                            <span id="username-alert" class="text-danger"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"> </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-8 form-back"> 
                                    <div class="form-group">
                                        <label for="password">Password</label>  
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Password.." autocomplete="off" required >
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
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-8 form-back"> 
                                    <div class="form-group">
                                        <label for="recoveryPin">Recovery Pin</label>  
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input class="form-control" type="text" id="recoveryPin" name="recoveryPin" placeholder="Recovery pin.." autocomplete="off" required >
                                            <span id="recoveryPin-alert" class="text-danger"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"> </div>
                            </div>

                            <div class="row ">
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-8 form-back">
                                    
                                    <div class="form-group">
                                        <label for="institute">Institute</label> 
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input class="form-control" type="text"  name="institute" placeholder="Institute.."  autocomplete="off" >
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
                                            <input type="submit" class="btn btn-success btn-lg" value="Sign up" name="signup">
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

        <script type="text/javascript" src="js/signup.js"></script>
    </body>
</html>





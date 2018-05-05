function userValidation(){

    var userName= document.forms['signupForm']['userName'].value;
    var password= document.forms['signupForm']['password'].value;
    var confirmPassword= document.forms['signupForm']['confirmPassword'].value;
    var recoveryPin= document.forms['signupForm']['recoveryPin'].value;
    var institute= document.forms['signupForm']['institute'].value;

    var isError = 0;
    document.getElementById("username-alert").innerHTML="";
    document.getElementById("password-alert").innerHTML="";
    document.getElementById("confirmPassword-alert").innerHTML="";
    document.getElementById("recoveryPin-alert").innerHTML="";

    if(userName == "" || userName == null){
        document.getElementById("username-alert").innerHTML="Please fill the username field";
        isError=1;
    }else if(userName.length < 4){
        document.getElementById("username-alert").innerHTML="user name should be at least 4 charecters";
        isError=1;  
    }


    if(password == "" || password == null){
        document.getElementById("password-alert").innerHTML="Please fill the password field";
        isError=1;
    }else if(password.length > 15){
        document.getElementById("password-alert").innerHTML="password can not be greater than 15 charecters";
        isError=1;
    }


    if(confirmPassword=="" || confirmPassword==null){
        document.getElementById("confirmPassword-alert").innerHTML="Please confirm the password";
        isError=1;
    }else if(password != confirmPassword){
        document.getElementById("confirmPassword-alert").innerHTML="Password didn't match";
        isError=1;
    }

    var numberPattern = /^[0-9]+$/;
    if(recoveryPin=="" || recoveryPin== null){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be filled";
        isError=1;
    }else if(recoveryPin.length != 4 || isNaN(recoveryPin) || !numberPattern.test(recoveryPin)){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be 4 characters long Number";
        isError=1;
    }


    if(isError == 1){
        return false;
    }
    return true;

}
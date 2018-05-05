/*function passwordValidation(){

    var password= document.forms['setPasswordForm']['password'].value;
    var confirmPassword= document.forms['setPasswordForm']['confirmPassword'].value;

    var isError = 0;
    document.getElementById("password-alert").innerHTML="";
    document.getElementById("confirmPassword-alert").innerHTML="";

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
    }else if(confirmPassword.length > 15){
        document.getElementById("confirmPassword-alert").innerHTML="password can not be greater than 15 charecters";
        isError=1;
    }else if(password != confirmPassword){
        document.getElementById("confirmPassword-alert").innerHTML="Password didn't match";
        isError=1;
    }
    if(isError == 1){
        return false;
    }
    return true;

}*/

function passwordValidation(){

    var password= document.forms['setPasswordForm']['password'].value;
    var confirmPassword= document.forms['setPasswordForm']['confirmPassword'].value;

    var isError = 0;
    document.getElementById("password-alert").innerHTML="";
    document.getElementById("confirmPassword-alert").innerHTML="";

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
    }else if(confirmPassword.length > 15){
        document.getElementById("confirmPassword-alert").innerHTML="password can not be greater than 15 charecters";
        isError=1;
    }else if(password != confirmPassword){
        document.getElementById("confirmPassword-alert").innerHTML="Password didn't match";
        isError=1;
    }
    if(isError == 1){
        return false;
    }
    return true;

}
/*
function validateRecoveryForm(){
		  	
	var userName=document.forms["recoverAccountForm"]["userName"].value;
	var recoveryPin=document.forms["recoverAccountForm"]["recoveryPin"].value;
    var isError = 0;
    document.getElementById("username-alert").innerHTML="";
    document.getElementById("recoveryPin-alert").innerHTML="";
	
	if(userName == "" || userName == null){
        document.getElementById("username-alert").innerHTML="Please fill the username field";
        isError=1;
    }
    var numberPattern = /^[0-9]+$/;
    if(recoveryPin=="" || recoveryPin== null){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be filled";
        isError=1;
    }else if(recoveryPin.length != 4  ){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be 4 characters long Number";
        isError=1;
    }else if(isNaN(recoveryPin) || !numberPattern.test(recoveryPin)){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be Number";
        isError=1;
    }


    if(isError == 1){
        return false;
    }
    return true;
} 
*/

function validateRecoveryForm(){
            
    var userName=document.forms["recoverAccountForm"]["userName"].value;
    var recoveryPin=document.forms["recoverAccountForm"]["recoveryPin"].value;
    var isError = 0;
    document.getElementById("username-alert").innerHTML="";
    document.getElementById("recoveryPin-alert").innerHTML="";
    
    if(userName == "" || userName == null){
        document.getElementById("username-alert").innerHTML="Please fill the username field";
        isError=1;
    }
    var numberPattern = /^[0-9]+$/;
    if(recoveryPin=="" || recoveryPin== null){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be filled";
        isError=1;
    }/*else if(recoveryPin.length != 4  ){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be 4 characters long Number";
        isError=1;
    }else if(isNaN(recoveryPin) || !numberPattern.test(recoveryPin)){
        document.getElementById("recoveryPin-alert").innerHTML="Recovery Pin must be Number";
        isError=1;
    }*/


    if(isError == 1){
        return false;
    }
    return true;
} 

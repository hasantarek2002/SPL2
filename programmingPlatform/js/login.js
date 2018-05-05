/*function validateLoginForm(){
		  	
  	var password="";
	var userName=document.forms["loginForm"]["userName"].value;
	password=document.forms["loginForm"]["password"].value;
	
	if(userName =="" || userName == null){
		alert("User name must be flled out.");
		return false;
	}
	if(password =="" || password == null){
		alert("password must be flled out.");
		return false;
	}

} */

function validateLoginForm(){
		
	document.getElementById("username-alert").innerHTML= "";
	document.getElementById("password-alert").innerHTML= "";
	var userName="";  	
  	var password="";
	userName=document.forms["loginForm"]["userName"].value;
	password=document.forms["loginForm"]["password"].value;
	
	var isError=0;

	if(userName == "" || userName == null){
        document.getElementById("username-alert").innerHTML="Please fill the username field";
        isError=1;
    }

	if(password =="" || password == null){
		document.getElementById("password-alert").innerHTML="Please fill the password field";
		isError=1;
	}

	if(isError==1){
		return false;
	}

	return true;

} 
function validateLoginForm(){
		  	
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

} 
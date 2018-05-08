function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}
function imageValidation(){
    var input=document.getElementById('imageFleInput');
    var file = input.files[0];
    var imageFile=document.forms["imageForm"]["file"].value;
    var imageFileExtension=getExtension(imageFile);
    //document.getElementById('demo').innerHTML=imageFileExtension;

    if(file.size > 500000){
        alert("Image should be less than 500 KB");
        return false;
    }
    if(imageFileExtension == "jpg" || imageFileExtension == "png" || imageFileExtension == "jpeg"){
        //alert("Image should be of jpg or png type");
        return true;
    }else{
        alert("Image should be of jpg or png or jpeg type");
        return false;
    }
    return true;
}
<?php  
 include_once ("connection.php");
$problemId = isset($_GET['problemId'])? $_GET['problemId'] : "";
$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
//echo "contest id".$contestId.'<br>';
$sql="SELECT questionFile FROM problem WHERE problemId=$problemId ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
 ?>  
 <!DOCTYPE html> 
 <html> 
      <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script src="bootstrap/js/jquery.min.js"></script>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <script src="bootstrap/js/bootstrap.min.js"></script>

      <script type="text/javascript">
        function validateForm(){
          //var submittedCode=document.getElemenyById("submittedCode").value;
          var submittedCode=document.forms['codeForm']['code'].value;
          if(submittedCode == ""){
            alert("submit your code first");
            return false;
          }

          
          return true;
        } 
      </script>

      <title>problems for a Contest</title>
    </head>

      <body> 

           <div class="container"> 
             <div class="row">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src='viewPDFFileUsingTable.php?id= "<?php echo $problemId; ?>"' height="500" width="1080"></iframe>
                </div>
                
              </div>
              <br><br><br>

            <form name="codeForm"  action='compileCode.php?problemId=<?php echo $problemId."&contestId=$contestId"; ?>' onsubmit="return validateForm()" method="post">
              <div class="form-group">
                <div class="col-sm-2">          
                  <select name="selectedLanguage" class="form-control" id="language">
                  <option value="C" selected>C</option>
                  <option value="C++" >C++ </option>
                </select>
                </div>
                <div class="col-sm-10">         
                  <textarea class="form-control" rows="12" name="code" id="submittedCode" required></textarea>
                </div>

              </div>


              <div class="form-group">        
                <div class="col-sm-offset-6">
                  <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </div>
              </div>
            </form>
      </body>  

 </html>
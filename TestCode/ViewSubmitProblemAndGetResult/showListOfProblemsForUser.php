<?php  
 include_once ("connection.php");
$contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";

$sql="SELECT * FROM problem WHERE contestId=$contestId ";
$result = mysqli_query($conn, $sql);
 
 ?>  
 <!DOCTYPE html>  
 <html> 
      <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script src="bootstrap/js/jquery.min.js"></script>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

      <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
      <script type="text/javascript" src="DataTables/datatables.min.js"></script>

      <script src="bootstrap/js/bootstrap.min.js"></script>

      <title>problems for a Contest</title>
    </head>

      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Contests</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="problemData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Id</td>  
                                    <td>Name</td>
                               </tr>  
                          </thead>  
                          <?php
                          while($row = mysqli_fetch_array($result))  
                          {  

                            echo '<tr>
                                <td>'.$row["problemId"].'</td>
                                <td>';
                                echo "<a href='problemSubmitPage.php?problemId=".$row['problemId']."&contestId=$contestId"."' target='_blank'>".$row['problemName']."</a>".'</td></tr>';
                                
                            
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#problemData').DataTable();  
 });  
 </script>  
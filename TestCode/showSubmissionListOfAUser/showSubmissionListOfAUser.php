<?php  
 include_once ("connection.php");
 $userName="shihab";
 //$userName="hasan";
 $sql = "SELECT * FROM submission WHERE userName='$userName' ORDER BY submissionId DESC";
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

      <title>Contest data</title>
    </head>

      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Submissions</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="contestData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Submission ID</td>  
                                    <td>Problem Name</td>  
                                    <td>Contest ID</td>  
                                    <td>User name</td> 
                                    <td>Compiler</td> 
                                    <td>Verdict</td> 
                                    <td>Sunmission time</td> 
                               </tr>  
                          </thead>  
                          <?php
                          while($row = mysqli_fetch_array($result))  
                          {  
                            $contestId=$row['contestId'];
                            echo '<tr>
                                <td>'.$row["submissionId"].'</td>
                                <td>';
                            echo "<a href='problemSubmitPage.php?problemId=".$row['problemId']."&contestId=$contestId"."' target='_blank'>".$row['problemName']."</a>".'</td>';

                            echo '<td>'.$row["contestId"].'</td>
                                <td>'.$row["userName"].'</td>
                                <td>'.$row["compiler"].'</td>
                                <td>'.$row["verdict"].'</td>
                                <td>'.$row["timestamp"].'</td></tr>';
                                
                            
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#contestData').DataTable();  
 });  
 </script>  
<?php  
 include_once ("connection.php");
 $sql = "SELECT * FROM contest ORDER BY contestId DESC";
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
                <h3 align="center">Contests</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="contestData" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Id</td>  
                                    <td>Name</td>  
                                    <td>Starting time</td>  
                                    <td>Duration</td> 
                               </tr>  
                          </thead>  
                          <?php
                          while($row = mysqli_fetch_array($result))  
                          {  

                            echo '<tr>
                                <td>'.$row["contestId"].'</td>
                                <td>';
                                echo "<a href='showListOfProblemsForUser.php?contestId=".$row['contestId']."' target='_blank'>".$row['contestName']."</a>".'</td>';
                                echo '<td>'.$row["startingTime"].'</td>  
                                    <td>'.$row["duration"].'</td>
                               </tr> ';
                            /*
                               echo '  
                               <tr>  
                                    <td>'.$row["contestId"].'</td>  
                                    <td>'.$row["contestName"].'</td>  
                                    <td>'.$row["startingTime"].'</td>  
                                    <td>'.$row["duration"].'</td>
                               </tr>  
                               ';  
                               */
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
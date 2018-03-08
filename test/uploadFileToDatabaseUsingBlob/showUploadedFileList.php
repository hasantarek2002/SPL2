<?php

include "connection.php";

$sql = "SELECT id, name, question, input, output FROM file";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table><tr> <th>id</th> <th>problem name</th>  <th>question name</th>  <th>input file name</th> <th>output file name</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
    echo '<tr> <td>'.$row["id"].'</td> <td>'. $row["name"].'</td> <td>'.$row["question"].'</td> <td>'.$row["input"].'</td> <td>'.$row["output"].'</td>  </tr>';

        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
    echo "</table>";
} 
else{
    echo "0 results";
}

?>

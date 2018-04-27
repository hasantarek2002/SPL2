 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table

$sql ="CREATE TABLE contest (
    contestId INT(11) AUTO_INCREMENT,
    contestName varchar(50) NOT NULL,
    userName varchar(50) NOT NULL,
    startingTime varchar(50) NOT NULL,
    duration varchar(50) NOT NULL,
    PRIMARY KEY (contestId)
)"; 

//$sql ="DROP TABLE contest";

if (mysqli_query($conn, $sql)) {
    echo "Table contest created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
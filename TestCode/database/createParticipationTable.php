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

$sql ="CREATE TABLE participation (
    participationId INT(11) AUTO_INCREMENT,
    contestId INT(11) NOT NULL,
    userName varchar(50) NOT NULL,
    numberOfProblemSolved INT(4) DEFAULT '0' NOT NULL,
    timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (participationId)
)"; 
//date_registered TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
//$sql ="DROP TABLE participation";

if (mysqli_query($conn, $sql)) {
    echo "Table participation created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
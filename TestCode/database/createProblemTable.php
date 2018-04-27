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

$sql ="CREATE TABLE problem (
    problemId INT(11) AUTO_INCREMENT,
    contestId INT(11) NOT NULL,
    problemName varchar(50) NOT NULL,
    timeLimit INT(4) DEFAULT '2' NOT NULL,
    questionFile varchar(50) NOT NULL,
    inputFile varchar(50) NOT NULL,
    solutionFile varchar(50) NOT NULL,
    PRIMARY KEY (problemId)
)"; 

//$sql ="DROP TABLE problem";

if (mysqli_query($conn, $sql)) {
    echo "Table problem created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
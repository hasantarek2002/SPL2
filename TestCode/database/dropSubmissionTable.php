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

/*$sql ="CREATE TABLE submission (
    submissionId INT(11) AUTO_INCREMENT,
    problemId INT(11) NOT NULL,
    problemName varchar(50) NOT NULL,
    contestId INT(11) NOT NULL,
    userName varchar(50) NOT NULL,
    compiler varchar(50) NOT NULL,
    verdict varchar(50) NOT NULL,
    timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (submissionId)
)"; */
//date_registered TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
$sql ="DROP TABLE submission";

if (mysqli_query($conn, $sql)) {
    echo "Table submission deleted successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
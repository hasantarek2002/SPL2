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

$sql ="CREATE TABLE users (
    userName varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    recoveryPin varchar(50) NOT NULL,
    userType varchar(50) NOT NULL,
    institute varchar(50),
    PRIMARY KEY (userName)
)"; 

//$sql ="DROP TABLE users";

if (mysqli_query($conn, $sql)) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
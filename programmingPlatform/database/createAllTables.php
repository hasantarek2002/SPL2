 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testDatabase";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//users table
$sql1 ="DROP TABLE users";
if (mysqli_query($conn, $sql1)) {
    echo "Table users deleted successfully".'<br>';
} else {
    echo "Error Deleting table: " . mysqli_error($conn).'<br>';
}

$sql2 ="CREATE TABLE users (
    userName varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    recoveryPin varchar(50) NOT NULL,
    userType varchar(50) NOT NULL,
    institute varchar(50),
    userImage varchar(50),
    fullName varchar(50),
    PRIMARY KEY (userName)
)";
if (mysqli_query($conn, $sql2)) {
    echo "Table users created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}

// create admin table
$userName='admin';
$password='1234';
$recoveryPin='1234';
$institute='IIT, DU';

$password=md5($password);
$recoveryPin=md5($recoveryPin);

$sql = "INSERT INTO users (userName, password, recoveryPin, userType,institute) VALUES('$userName', '$password','$recoveryPin', 'admin', '$institute')";
//$sql= "insert into users (username, password, recoveryPin) values('$username','$password', '$recovery_pin' )";
// mysqli_query($db, $sql);

if(mysqli_query($conn, $sql)){
        echo "Admin create with User Name : ".'admin'. ' ,Password : '.'1234'.' And recovery Pin '.'1234'.'<br>';
}else{
    echo "Admin account creation failed".'<br>';
}




//contest table
$sql3 ="DROP TABLE contest";
if (mysqli_query($conn, $sql3)) {
    echo "Table contest deleted successfully".'<br>';
} else {
    echo "Error Deleting table: " . mysqli_error($conn).'<br>';
}
$sql4 ="CREATE TABLE contest (
    contestId INT(11) AUTO_INCREMENT,
    contestName varchar(50) NOT NULL,
    userName varchar(50) NOT NULL,
    startingTime varchar(50) NOT NULL,
    duration varchar(50) NOT NULL,
    PRIMARY KEY (contestId)
)";
if (mysqli_query($conn, $sql4)) {
    echo "Table contest created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}



//problem table
$sql5 ="DROP TABLE problem";
if (mysqli_query($conn, $sql5)) {
    echo "Table problem deleted successfully".'<br>';
} else {
    echo "Error Deleting table: " . mysqli_error($conn).'<br>';
}

$sql6 ="CREATE TABLE problem (
    problemId INT(11) AUTO_INCREMENT,
    contestId INT(11) NOT NULL,
    problemName varchar(50) NOT NULL,
    timeLimit INT(4) DEFAULT '2' NOT NULL,
    questionFile varchar(50) NOT NULL,
    inputFile varchar(50) NOT NULL,
    solutionFile varchar(50) NOT NULL,
    PRIMARY KEY (problemId)
)"; 
if (mysqli_query($conn, $sql6)) {
    echo "Table problem created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}



//submission table
$sql7 ="DROP TABLE submission";
if (mysqli_query($conn, $sql7)) {
    echo "Table submission deleted successfully".'<br>';
} else {
    echo "Error Deleting table: " . mysqli_error($conn).'<br>';
}

$sql8 ="CREATE TABLE submission (
    submissionId INT(11) AUTO_INCREMENT,
    problemId INT(11) NOT NULL,
    problemName varchar(50) NOT NULL,
    contestId INT(11) NOT NULL,
    userName varchar(50) NOT NULL,
    compiler varchar(50) NOT NULL,
    verdict varchar(50) NOT NULL,
    timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (submissionId)
)";
if (mysqli_query($conn, $sql8)) {
    echo "Table submission created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}


//participation table

$sql9 ="DROP TABLE participation";
if (mysqli_query($conn, $sql9)) {
    echo "Table participation deleteded successfully".'<br>';
} else {
    echo "Error Deleting table: " . mysqli_error($conn).'<br>';
}

$sql10 ="CREATE TABLE participation (
    participationId INT(11) AUTO_INCREMENT,
    contestId INT(11) NOT NULL,
    userName varchar(50) NOT NULL,
    numberOfProblemSolved INT(4) DEFAULT '0' NOT NULL,
    timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (participationId)
)"; 

if (mysqli_query($conn, $sql10)) {
    echo "Table participation created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}


mysqli_close($conn);
?> 
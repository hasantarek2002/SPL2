<?php
	session_start();
    if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'user') ){
        $path="../error.php";
	 	header('location:'.$path);
	 }
?>

<?php
    if(isset($_REQUEST['submit'])){
        include_once "../connection.php";
        $selectedLanguage=$_REQUEST['selectedLanguage'];
        $submittedCode=$_REQUEST['code'];
        $problemId = isset($_GET['problemId'])? $_GET['problemId'] : "";
        $contestId = isset($_GET['contestId'])? $_GET['contestId'] : "";
        //$userName="hasan";
        $userName=$_SESSION['userName'];

        $sql="SELECT * FROM problem WHERE problemId=$problemId ";
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $inputFile=$row['inputFile'];
        $solutionFile=$row['solutionFile'];
        $timeLimit=$row['timeLimit'];
        $problemName=$row['problemName'];

        //set actual directory
        $inputFile="../setContest/".$inputFile;
        $solutionFile="../setContest/".$solutionFile;


        if($selectedLanguage =="C"){
            include "CCode/c.php";
        }else if ($selectedLanguage == "C++") {
            include "CPPCode/cpp.php";
        }

        //echo "Verdict is".$verdict.'<br>';
        $sql2="INSERT INTO submission (problemId, problemName, contestId, userName, compiler, verdict) VALUES ('$problemId','$problemName','$contestId','$userName','$selectedLanguage', '$verdict') ";

        if(mysqli_query($conn, $sql2) ){
            $sql2="SELECT * FROM contest WHERE contestId=$contestId ";
            $result2 = mysqli_query($conn, $sql2);
            $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
            
            $initialTime=$row2['startingTime'];
            $endTime=$_SESSION['endTime'];
            date_default_timezone_set("Asia/Dhaka");
            $startTimeInSecond=strtotime($initialTime);
            $currentTimeInSecond=time();
            $endTimeInSecond=strtotime($endTime);
            
            if($currentTimeInSecond >= $startTimeInSecond &&       $currentTimeInSecond <= $endTimeInSecond ){
                $sql3="SELECT * FROM participation WHERE contestId= '$contestId' AND userName= '$userName' ";
                $result3 = mysqli_query($conn, $sql3);
                $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                $rowcount=mysqli_num_rows($result3);
                
                if($rowcount == 0){
                    $sql4="INSERT INTO participation (contestId, userName) VALUES ('$contestId','$userName') ";
                    
                    if (mysqli_query($conn, $sql4)) {
                        //echo "new rank  record created successfully";
                    } else {
                        //echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
                    }
                }
                
                $sql5="SELECT * FROM submission WHERE problemId='$problemId' AND contestId= '$contestId' AND userName= '$userName' AND verdict='Accepted'";
                $result5 = mysqli_query($conn, $sql5);
                //$row5 = mysqli_fetch_array($result5);
                $rowcount2=mysqli_num_rows($result5);
                
               $sql7="SELECT * FROM participation WHERE contestId= '$contestId' AND userName= '$userName' ";
                $result7 = mysqli_query($conn, $sql7); $row7=mysqli_fetch_array($result7,MYSQLI_ASSOC); $numberOfProblemSolved=$row7['numberOfProblemSolved'];
                
                
                if($rowcount2 == 1){
                    $numberOfProblemSolved = $numberOfProblemSolved + 1;
                    
                    date_default_timezone_set("Asia/Dhaka");
                    $date = date("Y-m-d H:i:s");
                    
                    $sql6 = "UPDATE participation SET numberOfProblemSolved='$numberOfProblemSolved', timestamp='$date' WHERE contestId='$contestId' AND userName='$userName'";
                    if (mysqli_query($conn, $sql6)) {
                        //echo "rank  record updated successfully";
                    } else {
                        //echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
                    }
                    
                }          
            }          
            
            //echo "data inserted into submission table<br>";
            header('location:showSubmissionList.php');
        }else{
            echo "data not inserted into submission table<br>";
            //$path2="../databaseErrorMessage.php";
            //header('location:'.$path2);
        }
    }
?>
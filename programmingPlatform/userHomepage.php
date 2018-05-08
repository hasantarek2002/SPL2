<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Homepage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="bootstrap/js/jquery.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/homepage.css">
    </head>

    <body>
        <nav class="navbar">
            <div class="container-fluid">

                <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>  
                <div class="navbar-header">
                    <a class="navbar-brand" href="adminHomepage.php">Programming Platform</a>
                </div>
                <?php } else { ?>
                <div class="navbar-header">
                    <a class="navbar-brand" href="userHomepage.php">Programming Platform</a>
                </div>
                <?php }  ?>

                <ul class="nav navbar-nav">
                    <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>  
                    <li class="active"><a href="adminHomepage.php">Home</a></li>
                    <?php } else { ?>
                    <li class="active"><a href="userHomepage.php">Home</a></li>
                    <?php }  ?>

                    <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'admin') { ?>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Contest <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="showContestList/showListOfContestsForAdmin.php">Show Contest</a></li>
                            <li><a href="setContest/contestInputPage.php">set new contest</a></li>
                            <li><a href="modifyContest/modifyContest.php">Edit contest</a></li>
                            <li><a href="deleteContest/deleteAContest.php">Delete contest</a></li>
                        </ul>
                    </li>
                    <li><a href="showContestList/showUpcomingContestListForAdmin.php">Upcoming Contests</a></li>
                    <?php } else { ?>
                    <li><a href="showContestList/showListOfContestsForUser.php">Contests</a></li>
                    <li><a href="showContestList/showUpcomingContestListForUser.php">Upcoming Contests</a></li>
                    <?php }  ?>

                    <?php if(isset($_SESSION['userName']) && $_SESSION['userType'] == 'user') { ?>
                    <li><a href="submitAndRunCode/showSubmissionList.php">Submissions</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile/showProfile.php">Profile</a></li>
                            <li><a href="profile/showSubmissionListForAUser.php">My Submissions</a></li>
                        </ul>
                    </li>
                    
                    <?php } else { ?>
                    <li><a href="profile/showProfile.php">Profile</a></li>
                    <?php }  ?>
                </ul>


                <?php if(!isset($_SESSION['userName'])) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile/showProfile.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['userName'] ?></a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                <?php }  ?>

            </div>
        </nav>

        <?php

        if(!isset($_SESSION['userName']) || (isset($_SESSION['userName']) && $_SESSION['userType'] != 'user') ){
            header('location:error.php');
        }
        ?>

        <br>
        <br>

        <div>
            <p class="home-text">
                Welcome to the world of programming.Let's begin our journey.World Programming is a UK-based private limited company that first started business in 2000. The Company develops and distributes a software product called WPS for the analysis, management, processing and reporting of data.

            </p>
        </div>


        <div id="myCarousel" class="carousel slide carousel-styling" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
                    <img src="image/pic1.png" alt=" first picture" style="width:100%; height: 400px;">
                    <div class="carousel-caption">
                        <h3>Welcome to the wold of Programming</h3>
                        <p> Programming is so much fun!</p>
                    </div>
                </div>

                <div class="item">
                    <img src="image/pic2.jpg" alt=" second picture" style="width:100%; height: 400px;">
                    <div class="carousel-caption">
                        <h3> Eat, Sleep, Code!!</h3>
                        <p> Coding will make you think wise!!!</p>
                    </div>
                </div>

                <div class="item">
                    <img src="image/pic3.jpg" alt="THird picture" style="width:100%; height: 400px;">
                    <div class="carousel-caption">
                        <h3> Eat, Sleep, Code!!</h3>
                        <p> Coding will make you think wise!!!</p>
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <br>


        <div class="container">

            <!--<div class="container-text">Avaiable Language</div>-->

            <div class="row">
                <div class="col-sm-4 img-center">
                    <img src="image/c-programming.png" id="icon" style="height: 150px; width: 150px;">
                    <h4>C</h4>
                </div>
                <div class="col-sm-4 img-center">
                    <img src="image/cpp.png" id="icon" style="height: 150px; width: 150px;">
                    <h4><center>C++</center></h4>
                </div>
                <div class="col-sm-4 img-center">
                    <img src="image/java.jpg" id="icon" style="height: 150px; width: 150px;">
                    <h4>Java</h4>
                </div>
            </div>
        </div>
        
        <div class="container">
            
            <ul class="nav nav-pills nav-justified">
                <li class="active"><a href="#C" data-toggle="tab">C</a></li>
                <li><a href="#CPP" data-toggle="tab">C++</a></li>
                <li><a href="#JAVA" data-toggle="tab">JAVA</a></li>
            </ul>

            <div class="tab-content">
                <br/><br/>
                <div class="tab-pane fade in active"  id="C">
                    <p class="lang-text">C was originally developed by Dennis Ritchie between 1969 and 1973 at Bell Labs,[6] and used to re-implement the Unix operating system.[7] It has since become one of the most widely used programming languages of all time,[8][9] with C compilers from various vendors available for the majority of existing computer architectures and operating systems. C has been standardized by the American National Standards Institute (ANSI) since 1989 (see ANSI C) and subsequently by the International Organization for Standardization (ISO).</p>
                </div>
                <div class="tab-pane fade"  id="CPP">
                    <p class="lang-text">C++ is standardized by the International Organization for Standardization (ISO), with the latest standard version ratified and published by ISO in December 2017 as ISO/IEC 14882:2017 (informally known as C++17).[8] The C++ programming language was initially standardized in 1998 as ISO/IEC 14882:1998, which was then amended by the C++03, C++11 and C++14 standards. The current C++17 standard supersedes these with new features and an enlarged standard library. Before the initial standardization in 1998, C++ was developed by Bjarne Stroustrup at Bell Labs since 1979, as an extension of the C language as he wanted an efficient and flexible language similar to C, which also provided high-level features for program organization. C++20 is the next planned standard thereafter.</p>
                </div>
                <div class="tab-pane fade"  id="JAVA">
                    <p class="lang-text">Java is a general-purpose computer-programming language that is concurrent, class-based, object-oriented,[15] and specifically designed to have as few implementation dependencies as possible. It is intended to let application developers "write once, run anywhere" (WORA),[16] meaning that compiled Java code can run on all platforms that support Java without the need for recompilation.[17] Java applications are typically compiled to bytecode that can run on any Java virtual machine (JVM) regardless of computer architecture. As of 2016, Java is one of the most popular programming languages in use,[18][19][20][21] particularly for client-server web applications, with a reported 9 million developers.[22] Java was originally developed by James Gosling at Sun Microsystems (which has since been acquired by Oracle Corporation) and released in 1995 as a core component of Sun Microsystems' Java platform. The language derives much of its syntax from C and C++, but it has fewer low-level facilities than either of them.</p> 
                </div>
            </div>
        </div>

        <br/><br/>
        <!--<div class="">
            <div class="page-footer">
                Developed by <br>
                Md. Hasan Tarek <br>
                Shayakh Shihab Uddin<br>
                Institute of Information Technology

        </div>-->

        <div class="left-footer">
            Developed by <br>
            Md. Hasan Tarek <br>
            Shayakh Shihab Uddin<br>
            Institute of Information Technology

        </div>


    </body>
</html>

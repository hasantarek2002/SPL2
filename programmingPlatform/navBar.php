<nav class="navbar navbar-inverse ">
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
          <li><a href="#">Show Contest</a></li>
          <li><a href="#">set new contest</a></li>
          <li><a href="#">Edit contest</a></li>
          <li><a href="#">Delete contest</a></li>
        </ul>
      </li>
      <?php } else { ?>
      <li><a href="#">contests</a></li>
      <?php }  ?>


      <li><a href="#">User Profile</a></li>
    </ul>


    <?php if(!isset($_SESSION['userName'])) { ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
    <?php } else { ?>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['userName'] ?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
    <?php }  ?>

  </div>
</nav>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>HiteSport</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7COpen+Sans:700,400%7CRaleway:400,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  </head>

  <body>
  <?php
  session_start();
    include("connection.php");
    $username = $_SESSION['username'];
    $result = $mysqli->query("SELECT * FROM `users` WHERE username = '$username'") or die($mysqli->error);
    $user = mysqli_fetch_assoc($result);


    
  ?>
    <!--HEADER START-->
    <div class="container-flui bg-dark">    
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/Logo.png" alt="" width="70" height="70"></a>
        <h3>Hit<span id="title-orange">eSport</span></h3>
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="matches.php">Matches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="<?php if (!isset($_SESSION['username']) || empty($_SESSION['username'])){
                echo'display:none';
              }else{
                if($_SESSION['username'] == "admin"){
                  echo 'display:block;';
                }else echo 'display:none;';
              } 
              
                ?>" href="#">Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="<?php if (!isset($_SESSION['username']) || empty($_SESSION['username'])) echo 'display:block;';else echo'display:none' ?>" href="login.php">Log in</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" style="<?php if (!isset($_SESSION['username']) || empty($_SESSION['username'])) echo 'display:none;';else echo'display:block' ?>" href="myprofile.php">My Profile(<span id="user"><?=$_SESSION['username']?></span>)</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" style="<?php if (!isset($_SESSION['username']) || empty($_SESSION['username'])) echo 'display:none;';else echo'display:block' ?>" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
<!--HEADER END-->

<!--BODY START-->
<div class="container-fluid">
    <div class="row py-5 px-3">
        <div class="user-info bg-light col-10 col-md-5 col-sm-10 col-lg-4 py-5 px-3 shadow-lg p-3 mb-5 bg-white rounded vertical-center">   
            <div class="user-avatar text-center align-bottom">
                <img src="img/user.png" alt="" height="200" width="200">
                <div class="display-6 m-5"><?= $_SESSION['username']?></div>
                <p class="text-muted m-5 h5">Here you can view all your information.<br>Scroll down to change our password</p>
                <span class="fa fa-arrow-down fa-1x" href="#"></a>
            </div>
        </div>
        <div class="user-data col-lg-5 col-md-5 ">
            <div class="card m-3">
                <div class="card-header bg-warning">
                <i class="fa fa-id-card"></i> ID 
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $user['id']?></h5>
                </div>
            </div>
            <div class="card m-3">
                <div class="card-header bg-warning">
                    <i class="fa fa-user"></i> Username
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $user['username']?></h5>
                </div>
            </div>
            <div class="card m-3">
                <div class="card-header bg-warning">
                    <i class="fa fa-envelope"></i> Email
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $user['email']?></h5>
                </div>
            </div>
            <div class="card m-3">
                <div class="card-header bg-warning">
                    <i class="fa fa-gamepad"> </i> Game
                </div>
                <div class="card-body">
                    <img src="img/games/<?= $user['gameid'];?>.jpg" alt="" height="50" width="50">
                </div>
            </div>
            <div class="card m-3">
                <div class="card-header bg-warning">
                    <i class="fa fa-lock"></i> Password
                </div>
                <div class="card-body">
                    <h5 class="card-title">**************</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center m-3">
        <a href="changepass.php"><button class="btn btn-lg btn-success btn-block" name="psw_update" type="submit">Change Password</button> </a>
    </div>

</div>
</div>
<!--BODY END-->

<!--FOOTER START-->
<div class="container-flui bg-dark">
  <footer class="container py-5">
    <div class="row">
      <div class="col-12 col-md">
        <a class="navbar-brand" href="#"><img src="img/Logo.png" alt="" width="24" height="24"></a>
        <small class="d-block mb-3 text-muted">&copy;2020 Hitesh Joshi</small>
      </div>
      <div class="col-6 col-md">
        <h5 style="color:white">Find Us</h5>
        <span class="link-secondary">Millennium Point<br>
          Curzon Street<br>
          Birmingham<br>
          B4 7XG<br>
          United Kingdom</span>
      </div>
      <div class="col-6 col-md">
        <h5 style="color:white">Contact Us</h5>
        <ul class="list-unstyled text-small">
          <li><a class="link-secondary" target="_blank" href="https://github.com/hite-js">GitHub</a></li>
          <li><a class="link-secondary" href="mailto:hiteshjoshi7777@gmail.com">Email</a></li>
          <li><a class="link-secondary" href="#">Contact Us Form</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5 style="color:white">Socials</h5>
        <ul class="list-unstyled text-small">
          <li><a class="link-secondary" href="#">Facebook</a></li>
          <li><a class="link-secondary" href="#">Instagram</a></li>
          <li><a class="link-secondary" href="#">Twitter</a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/1617420e07.js"></script>
  </body>
</html>

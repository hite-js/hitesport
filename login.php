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
      
      $_SESSION['message'] = '';
      $_SESSION['visibility'] = 'hidden';
      $_SESSION['alert'] = 'danger';
    if(isset($_POST['username'])){
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE username='$username'AND password='$password'";

        $result = $mysqli->query($sql) or die($mysqli->error);

        if(mysqli_num_rows($result)==1){
            $_SESSION['username'] = $username;
            header("location: index.php");
        }else{
            $_SESSION['visibility'] = 'visible';
            $_SESSION['message'] = 'Wrong credentials!';
        }
    }
      

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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
<div class="form-container">
  <div class="form-signin">
    <form action="login.php" method="post" autocomplete="off">
      <img class="mb-4" src="img/Logo.png" alt="" width="80" height="80">
      <div class='alert alert-<?=$_SESSION["alert"]?>' style='visibility:"'<?=$_SESSION["visibility"]?> role="alert"><?= $_SESSION["message"]?></div>
      <h1 class="h3 mb-3 fw-normal">Log In</h1>
      <label for="inputUsername" class="visually-hidden">Username</label>
      <input type="username" name="username" id="inputUsername" class="form-control" placeholder="Username*" required autofocus>
      <label for="inputPassword" class="visually-hidden">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password*" required>
      <span class="register">Don't have an account? Click <a href="signup.php">here</a> to make one</span><br><br>
      <button class="btn btn-lg btn-warning btn-block" type="submit">Log In</button>     
    </form>
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
  <script src="https://kit.fontawesome.com/9bdc79117a.js" crossorigin="anonymous"></script>
  </body>

</html>

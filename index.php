<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>HiteSport</title>
    <link rel="icon" href="img/Logo.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7COpen+Sans:700,400%7CRaleway:400,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  </head>

  <body>
  <?php
  session_start();
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
              
                ?>" href="admins.php">Admins</a>
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
<div class="container-flui">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/carousel/first.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-md-block">
          <h5>Create un account</h5>
          <p>Share with us your enthusiasm and join our community</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/carousel/second.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-md-block">
          <h5>Watch matches</h5>
          <p>Click on the matches tab to view results</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/carousel/third.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-md-block">
          <h5>Step up your game</h5>
          <p>Join a team and win prizes</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>
</div>
<!--HEADER END-->

<!--BODY START-->
<div class="starter-template text-center py-5 px-3 bg-light">
  <h1>Taking eSport to the next level</h1>
  <p class="lead">We are a leading eSport company that excels in managing big tournaments and host privates matches between teams. You can build your career with us.<br> 
    Scroll down to find more</p>
    <div class="arrow bounce">
      <span class="fa fa-arrow-down fa-2x" href="#"></a>
    </div>
</div>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Matches" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#fc0" dy=".3em">View Matches</text></svg>

          <div class="card-body">
            <p class="card-text">Support your favourite team by watching their matches. Click on "matches" at the top or on the button below.</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="matches.php"><button type="button" class="btn btn-sm btn-outline-secondary">Matches</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#fc0" dy=".3em">Create Account</text></svg>
          <div class="card-body">
            <p class="card-text">You haven't made an account yet? What are you waiting for? Click below to make an account or use "Log In" at the top</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="signup.php"><button type="button" class="btn btn-sm btn-outline-secondary">Register</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
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

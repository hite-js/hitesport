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
    $result = $mysqli->query("SELECT * FROM `matches`") or die($mysqli->error);
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
<!--HEADER END-->

<!--BODY START-->
<h3 class="display-6 text-center">Matches List</h3>
<h5 class="text-center">Upcoming Matches</h5>
<div class="container-fluid">
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Team 1</th>
        <th scope="col">Team 2</th>
        <th scope="col">Game</th>
        <th scope="col">Result</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $data = array();
      while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
      }
      foreach ($data as $row) {
        if($row['result'] == null){
          $team1id_query = $mysqli->query("SELECT name FROM `teams` WHERE id = ".$row['team1id']."") or die($mysqli->error);
          $team2id_query = $mysqli->query("SELECT name FROM `teams` WHERE id = ".$row["team2id"]."") or die($mysqli->error);
          $team1 = mysqli_fetch_assoc($team1id_query);
          $team2 = mysqli_fetch_assoc($team2id_query);
    ?>
      <tr>
        <th class= "align-middle" scope="row"><?= $row["id"];?></th>
        <td class= "h6 align-middle"><?= $team1['name'];?></td>
        <td class= "h6 align-middle"><?= $team2['name'];?></td>
        <td><img src="img/games/<?= $row['gameid'];?>.jpg" alt="" height="50" width="50"></td>
        <td class="align-middle text-secondary" style="font-weight:900">TBA</td>
      </tr>
    <?php
        }
      }
    ?>
    </tbody>
  </table>
</div>
<h5 class="text-center">Past Matches</h5>
<div class="container-fluid">
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Team 1</th>
        <th scope="col">Team 2</th>
        <th scope="col">Game</th>
        <th scope="col">Result</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($data as $row) {
        if($row['result'] != null){
          $team1id_query = $mysqli->query("SELECT name FROM `teams` WHERE id = ".$row['team1id']."") or die($mysqli->error);
          $team2id_query = $mysqli->query("SELECT name FROM `teams` WHERE id = ".$row["team2id"]."") or die($mysqli->error);
          $team1 = mysqli_fetch_assoc($team1id_query);
          $team2 = mysqli_fetch_assoc($team2id_query);
        
        
    ?>
      <tr>
        <th class= "align-middle" scope="row"><?= $row["id"];?></th>
        <td class= "h6 align-middle"><?= $team1['name'];?></td>
        <td class= "h6 align-middle"><?= $team2['name'];?></td>
        <td><img src="img/games/<?= $row['gameid'];?>.jpg" alt="" height="50" width="50"></td>
        <td class="align-middle h4 text-info" style="font-weight:900"><?= $row['result'];?></td>
      </tr>
    <?php
        }
      }
    ?>
    </tbody>
  </table>
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

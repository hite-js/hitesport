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
    $result = $mysqli->query("SELECT id,username,email,gameid FROM `users`") or die($mysqli->error);
    $teamsel = $mysqli->query("SELECT name,id FROM `teams`") or die($mysqli->error);

    $_SESSION['visibility'] = 'hidden';
    $_SESSION['alert'] = 'danger';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['creatematch'])){
      if(isset($_POST['first_team']) && isset($_POST['second_team'])){
        $team1 = $mysqli->real_escape_string($_POST['first_team']);
        $team2 = $mysqli->real_escape_string($_POST['second_team']);
        $matchresult = $mysqli->real_escape_string($_POST['result']);
        if($team1 != $team2){
          $adminid_query = $mysqli->query("SELECT id FROM `users` WHERE username = \"admin\"") or die($mysqli->error);
          $adminid = mysqli_fetch_assoc($adminid_query);
          $admin_id = $adminid['id'];
          $team1_game_q = $mysqli->query("SELECT gameid FROM `teams` WHERE id = " .$_POST['first_team']."") or die($mysqli->error);
          $team2_game_q = $mysqli->query("SELECT gameid FROM `teams` WHERE id = " .$_POST['second_team']."") or die($mysqli->error);
          $team1_game = mysqli_fetch_assoc($team1_game_q);
          $team2_game = mysqli_fetch_assoc($team2_game_q);
          if($team1_game['gameid'] == $team2_game['gameid']){
            $creatematch_query =  "INSERT INTO matches (team1id, team2id, adminid, result, gameid) VALUES('$team1', '$team2', '$admin_id', '$matchresult',".$team1_game["gameid"].")";
            $mysqli->query($creatematch_query) or die($mysqli->error);
            $_SESSION['visibility'] = 'visible';
            $_SESSION['alert'] = 'success';
            $_SESSION['message'] = "Match created";
          }else{
            $_SESSION['visibility'] = 'visible';
          $_SESSION['message'] = 'The teams do not play the same game';
          }
        }else{
          $_SESSION['visibility'] = 'visible';
          $_SESSION['message'] = 'The teams cannot be the same';
        }
      }else{
        $_SESSION['visibility'] = 'visible';
        $_SESSION['message'] = 'Teams are not set';
      }    
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createteam'])){
      $name = $mysqli->real_escape_string($_POST['name']);
      $gameid = $mysqli->real_escape_string($_POST['game']);
      $mysqli->query("INSERT INTO teams (name,gameid) VALUES('$name','$gameid')") or die($mysqli->error);
      $_SESSION['visibility'] = 'visible';
      $_SESSION['alert'] = 'success';
      $_SESSION['message'] = "Team created";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addgame'])){
      $gamename = $mysqli->real_escape_string($_POST['gamename']);
      $mysqli->query("INSERT INTO games (name) VALUES('$gamename')") or die($mysqli->error);
      $_SESSION['visibility'] = 'visible';
      $_SESSION['alert'] = 'success';
      $_SESSION['message'] = "Game added";
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
<div class='alert alert-<?=$_SESSION["alert"]?>' style='visibility:"'<?=$_SESSION["visibility"]?> role="alert"><?= $_SESSION["message"]?></div>
<h3 class="display-6 text-center">User Lists</h3>
<div class="container-fluid">
<div id="accordion">
<?php
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            if($row['username'] != $_SESSION['username']){
                $i++;
    ?>
    <div class="card">
    <div class="card-header" id= "<?php echo "heading$i"?>">
      <h5 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="<?php echo "#collapse$i"?>" aria-expanded="false" aria-controls="<?php echo "collapse$i"?>">
        <?= $row["username"];?>
        </button>
      </h5>
    </div>
    <div id="<?php echo "collapse$i"?>" class="collapse" aria-labelledby="<?php echo "heading$i"?>" data-parent="#accordion">
      <div class="card-body text-center">
        <span style="font-weight:900" name="id">Id: </span> <?= $row["id"];?><br>
        <span style="font-weight:900" id="<?= $row["id"];?>">Username: </span> <?= $row["username"];?><br>
        <span style="font-weight:900" id="<?= $row["id"];?>">Email: </span> <?= $row["email"];?><br>
        <span style="font-weight:900" id="<?= $row["id"];?>">Gameid: </span> <?= $row["gameid"];?><br><br>
        <a href="delete.php?id=<?php echo $row['id']?>"><button class="btn btn-danger" type="button">Delete Account</button></a>
      </div>
    </div>
  </div>
  <?php
        }
    }
      ?>
  </div>
</div>
</div>
<!--MATCHES END-->
<h3 class="display-6 text-center">Matches Manager</h3>
  <div class="container-fluid">
    <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#exampleModal">
      Create Match
    </button>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Match</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admins.php" method="post" autocomplete="off">
                <select class="form-control selectpicker" name="first_team" required="true" placeholder="Team_1*">
                  <option value="" disabled selected>Team 1</option>
                  <?php
                    $data = array();
                    while ($row = mysqli_fetch_assoc($teamsel)){
                        $data[] = $row;
                    }
                    foreach ($data as $row) {
                      echo '<option value="'. $row['id'] .'">'. $row['id']. ' - ' . $row['name'] . '</option>';
                    }
                  ?>
                </select><br>
                <select class="form-control selectpicker" name="second_team" required="true" placeholder="Team_2*">
                  <option value="" disabled selected>Team 2</option>
                  <?php
                    foreach ($data as $row) {
                      echo '<option value="'. $row['id'] .'">' . $row['id']. ' - ' . $row['name'] . '</option>';
                    }
                  ?>
                </select><br>
                <label for="result" class="visually-hidden">Result</label>
                <input type="result" name="result" id="result" class="form-control" placeholder="Result(not required)" autofocus><br><br>
                <button class="btn btn-lg btn-success btn-block" name="creatematch" type="submit">Create Match</button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


<!--TEAMS START-->
<h3 class="display-6 text-center">Team Manager</h3>
    <div class="container-fluid">
    <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#teamModal">
      Create Team
    </button>
    <div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="teamModalLabel">Create Team</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admins.php" method="post" autocomplete="off">
                <label for="name" class="visually-hidden">Name</label>
                <input type="name" name="name" id="name" class="form-control" placeholder="Name*" required autofocus><br>
                <select class="form-control selectpicker" name="game" required="true" placeholder="Team_2*">
                  <option value="" disabled selected>Select game</option>
                  <?php
                    $games = $mysqli->query("SELECT id,name FROM `games`") or die($mysqli->error);
                    while ($row = mysqli_fetch_array($games)) {
                      echo '<option value="'. $row['id'] .'">' . $row['id'] . ' - ' . $row['name'] . '</option>';
                    }
                  ?>
                </select><br>
                <button class="btn btn-lg btn-success btn-block" name="createteam" type="submit">Create Team</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<h3 class="display-6 text-center">Game Manager</h3>
    <div class="container-fluid">
    <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#gameModal">
      Add Game
    </button>
    <div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="gameModalLabel">Add game</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admins.php" method="post" autocomplete="off">
                <label for="gamename" class="visually-hidden">Game Name</label>
                <input type="gamename" name="gamename" id="gamename" class="form-control" placeholder="Name of the game*" required autofocus><br>
                <button class="btn btn-lg btn-success btn-block" name="addgame" type="submit">Add Game</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
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

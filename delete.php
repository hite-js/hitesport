<?php

$user = 'root';
$pass = '';
$db = 'hitesport';
$mysqli = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

$id = $_GET['id'];
echo $id;
$query = "DELETE FROM users WHERE id = '$id'";
$data = mysqli_query($mysqli,$query);
if($data){
    header('location: admins.php');
    exit;
}else{
    echo "Account could not be found";
}

?>
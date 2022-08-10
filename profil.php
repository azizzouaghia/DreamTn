<?php 
session_start();
$title="Profile";
include('./temp/header.php'); 
include('conn.php'); 
$name = $conn->prepare("SELECT state FROM users WHERE name = :name");
$name->bindParam("name",$_SESSION["name"]);
$name->execute();
$user = $name->fetchObject();
if(isset($_SESSION['name'])){
  echo '
  <div class="card">
  <br>
  <img src="https://kalefamui.github.io/YouTube-page/Images/user-icon.png" alt="John" style="width:100%">
  <h1>'.$_SESSION["name"].'</h1>
  <p class="title">'. $user->state.'</p>
 <a href="userpanel.php"> <button>'.$lang["myp"].'</button></a>
</div>

  ';
}else {
  header('Location: login.php');
}

include('./temp/footer.php'); 
?>  
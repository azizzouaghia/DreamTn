<?php 
$title="Login";
session_start();
include('./temp/header.php'); 
include('conn.php'); 
if (isset($_SESSION["name"])){
  header('Location: index.php');
}
?>

<div class="container">
    <h2 class="logtit"><?php echo $lang["login"]; ?></h2>
    <form action="login.php" method="POST"  class='loginform'>
  <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $lang["user"]; ?></label>
    <input type="text" class="form-control" name="name" autocomplete="off" placeholder="<?php echo $lang["puser"]; ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><?php echo $lang["pass"]; ?></label>
    <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php echo $lang["ppass"]; ?>" required>
  </div>
  <button name="submit" type="submit" class="btn btn-dark"><?php echo $lang["login"]; ?></button>

<?php

$name = $_POST["name"];
$pass = $_POST["password"];
$log = $_POST["submit"];
$login = $conn->prepare("SELECT * FROM users WHERE name = :name AND password = :pass ");
$login->bindParam("name",$name);
$login->bindParam("pass",$pass);
$login->execute();
if(isset($log)){
  if($login->rowCount()>0) {
    echo' <br><br> <div class="alert text-center alert-success">
   ';
   echo $lang["welcome"] ;
    echo $name.'  </div>';
   $_SESSION['name'] = $name ;
   header( "refresh:1; url=index.php" ); 
   } else {
    echo ' <br><br> <div class="alert text-center alert-danger">';
    echo $lang["elogin"].'</div>' ; 
   }
}


?>


</form>
</div>

<?php 
include('./temp/footer.php'); 
?>
</html>
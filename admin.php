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
    <h2 class="logtit"><?php echo $lang["admin"]; ?></h2>
    <form action="admin.php" method="POST"  class='loginform'>
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
if(isset($log)){
if ($name =='admin' AND $pass =='0101Albedo10' ){
  echo' <br><br> <div class="alert text-center alert-success">
   Welcome '.$name.'  </div>';
  $_SESSION['name'] = $adkey ;
  header( "refresh:1; url=index.php" );
}else {
  echo ' <br><br> <div class="alert text-center alert-danger">
username or the password incorrect     </div>' ; 
 } }


?>


</form>
</div>

<?php 
include('./temp/footer.php'); 
?>
</html>
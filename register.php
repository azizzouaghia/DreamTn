<?php 
$title="Register";
include('./temp/header.php'); 
include('conn.php'); 
if (isset($_SESSION["name"])){
  header('Location: index.php');
}
?>

<div class="container">
<h2 class="logtit"><?php echo $lang["reg"]; ?></h2>
<form action="register.php" method="POST"  class='loginform'>
  <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $lang["user"]; ?></label>
    <input type="text" class="form-control" name="name" placeholder="<?php echo $lang["puser"]; ?>" required>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $lang["state"]; ?></label>
    <select class="form-control" name="state" id="state" required>
  <option value="Tunis">Tunis</option>
  <option value="Ariana">Ariana</option>
  <option value="BenArous">Ben Arous</option>
  <option value="Ariana">Ariana</option>
  <option value="Manouba">Manouba</option>
  <option value="Nabeul">Nabeul</option>
  <option value="Zaghouan">Zaghouan</option>
  <option value="Bizerte">Bizerte</option>
  <option value="Beja">Beja</option>
  <option value="Jendouba">Jendouba</option>
  <option value="Kef">Kef</option>
  <option value="Siliana">Siliana</option>
  <option value="Sousse">Sousse</option>
  <option value="Monastir">Monastir</option>
  <option value="Mahdia">Mahdia</option>
  <option value="Sfax">Sfax</option>
  <option value="Kairouan">Kairouan</option>
  <option value="Kasserine">Kasserine</option>
  <option value="Sidi Bouzid">Sidi Bouzid</option>
  <option value="Gabes">Gabes</option>
  <option value="Mednine">Mednine</option>
  <option value="Tataouine">Tataouine</option>
  <option value="Gafsa">Gafsa</option>
  <option value="Tozeur">Tozeur</option>
  <option value="Kebili">Kebili</option>
  
</select>   </div>

  <div class="form-group">
    <label for="exampleInputPassword1"><?php echo $lang["pass"]; ?></label>
    <input type="password" class="form-control" name="password" placeholder="<?php echo $lang["ppass"]; ?>" required>
  </div>

  <button name="submit" type="submit" class="btn btn-dark"><?php echo $lang["reg"]; ?></button>
</form>


<?php

$name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$state=filter_var($_POST['state'], FILTER_SANITIZE_STRING);
$password=$_POST["password"];
$rgst=$_POST["submit"];

$adduser = $conn->prepare("INSERT INTO users(name , state , password) 
VALUES(:name,:state,:password)");
$checkuser = $conn->prepare("SELECT name FROM users WHERE name = :name");
$checkuser->bindParam("name",$name);
$adduser->bindParam("name",$name);
$adduser->bindParam("state",$state);  
$adduser->bindParam("password",$password);
$checkuser->execute();
if(isset($rgst)) {
  if($checkuser->rowCount()>0) {
    echo' <br>  <div class="alert text-center alert-danger">
    username already uses    </div>';
  } else {
    if($adduser->execute()){
      echo' <br> <div class="alert text-center alert-success">
      User ADDED successfully
        </div>';
        header( "refresh:2; url=login.php" ); 
      }  else {
        echo' <br>  <div class="alert text-center alert-danger">
    there is a problem    </div>';  
      }
    
    }
  }



?>


</div>

<?php 
include('./temp/footer.php'); 
?>
<?php
session_start();
include("./temp/header.php");
include("conn.php");
if (!isset($_SESSION["name"])){
  header('Location: login.php');
}
?>
<div class="container logtit">
<h2> <?php echo $lang["posttit"]; ?> </h2>
<form action="addpost.php" method="post" enctype="multipart/form-data" >
<textarea name="text" class="form-control" placeholder="<?php echo $lang["thepost"]; ?>" id="" cols="30" rows="10"required></textarea>
<h3><?php echo $lang["addimg"]; ?> </h3>
<input class="interaction form-control " type="file" id="img" name="img" accept="image/*" required>
<h3> <?php echo $lang["addtown"]; ?></h3>
<select class="form-control" name="town" id="town" required>
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

</select>    <h3> <?php echo $lang["addneib"]; ?></h3>
<input type="text" class="form-control" name="neib" placeholder="<?php echo $lang["neibex"]; ?>" required>  <br>
<button name="submit" class="btn btn-primary"><?php echo $lang["postbtn"]; ?></button> <br> 
</form>

<?php

$text= filter_var($_POST['text'], FILTER_SANITIZE_STRING);
$town=filter_var($_POST['town'], FILTER_SANITIZE_STRING);
$neib=filter_var($_POST['neib'], FILTER_SANITIZE_STRING);

echo '<br>';

if(isset($_POST["submit"])) {
  $uploaddir = 'pics/';
  $piccheck = 0;
  $uploadfile = $uploaddir . basename($_FILES['img']['name']);
  $picname = basename($_FILES['img']['name']);
  if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
    $piccheck = 1;
  } else {
    echo  ' <div class="alert text-center alert-danger">
THERE IS A PROBLEME UPLOADING THE PICTURE
    </div>';
   }
  $postcheck = $conn->prepare("SELECT * FROM post WHERE text = :text AND img = :img");
  $addpost = $conn->prepare("INSERT INTO post(userid , text , img , town , neib ) 
  VALUES(:userid,:text,:img,:town,:neib)");
  $addpost->bindParam("userid",$id);
  $addpost->bindParam("text",$text);
  $postcheck->bindParam("text",$text);
  $postcheck->bindParam('img',$picname);
  $addpost->bindParam('img',$picname);
  $addpost->bindParam("town",$town);
  $addpost->bindParam("neib",$neib);
  $postcheck->execute();
     if($postcheck->rowCount() > 0 ) {

      echo  ' <div class="alert text-center alert-warning">
';
echo           $lang["epost"].'</div>';
     }else {
      if($addpost->execute() AND  $piccheck == 1  ){
        echo ' <div class="alert text-center alert-success">
';
echo        $lang["spost"].'</div>';
        header( "refresh:2; url=index.php" ); 
      }else {
        echo  ' <div class="alert text-center alert-danger">
         Failed to add the post
              </div>';
              
      }
     }

 }


echo '</div>';
include("./temp/footer.php");
?>
</html>
<?php
include('lang.php');
include('conn.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/bb11b5e11e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo  $title; ?></title>
</head> 
<body> 
  
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"> <span class="fas fa-dungeon"> Dream</span></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav ">
      <?php
if($_SESSION["name"]=='&G7k.T.:<Tr36fM;'){
        echo '  <li><a href="users.php"> <span class="fas fa-users-cog"></span> users</a></li>
        <li><a href="logout.php"> <span class="fas fa-sign-out-alt"></span> '. $lang["logout"] .'</a></li>

        ';  }

if (isset($_SESSION['name']) AND $_SESSION["name"]!==$adkey ) {
echo '<li><a href="profil.php"><span class="fas fa-user"></span> '. $lang["profile"] .'</a></li>
<li><a href="about.php"> <span class="fas fa-info-circle"></span> '. $lang["about"] .'</a></li>
<li><a href="logout.php"> <span class="fas fa-sign-out-alt"></span> '. $lang["logout"] .'</a></li>
';
} else if ($_SESSION["name"]!==$adkey AND !isset($_SESSION['name']) ) {
  echo'     <li><a href="register.php"><span class="fas fa-user-plus"></span> '. $lang["register"] .'</a></li>
  <li><a href="login.php"><span class="fas fa-sign-in-alt"></span> '. $lang["login"] .'</a></li>
  <li><a href="about.php"> <span class="fas fa-info-circle"></span> '. $lang["about"] .'</a></li>
  <li><a href="admin.php"> <span class="fas fa-users-cog"></span> '. $lang["admin"] .'</a></li>
';
} 


        ?>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fas fa-globe"></span> 
        <?php echo $lang["langs"] ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a id="eng" href="<?php  echo basename($_SERVER['PHP_SELF']) . "?lang=en" ; ?>">English</a></li>
          <li><a id="ar"  href="<?php  echo basename($_SERVER['PHP_SELF']) . "?lang=ar" ; ?>">عربي</a></li>
          <li><a id="fr"  href="#">Francais</a></li>
        </ul>
      </li>
      </ul>
    </div>
  </div>
</nav>



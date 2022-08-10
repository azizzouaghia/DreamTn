<?php
    $did=$_GET["delete"];
session_start();
$title="Comments";
include("./temp/header.php");
include("./conn.php");
?>

<div class="container">

<h2 class="logtit"><?php echo $lang["cmntbtn"]; ?></h2><br>

<?php 
$postid = $_GET['id'];
$checkid = $conn->prepare("SELECT * FROM post WHERE id = :id");
$checkid->bindParam("id",$postid);
$checkid->execute();
$post = $checkid->fetchObject();
if ($checkid->rowCount() == 0 ) {
    header('Location: index.php');
}

$showcmnt = $conn->prepare("SELECT * from cmnts WHERE postid = :postid");
$cshow = $conn->prepare("SELECT * from cmnts WHERE postid = :postid AND id=:id");
$cshow->bindParam("postid",$postid);
$cshow->bindParam("id",$did);
$showcmnt->bindParam("postid",$postid);
$showcmnt->execute();
$cshow->execute();
$ccmnt = $cshow->fetchObject();
echo '
<div class="boxx">
    
    <h5>
'.$post->text.'
    </h5>
    <img class="postimg" src="pics/'.$post->img.'" alt="" srcset=""> 
<h6 class="location"> <span class="fas fa-location-arrow"></span> '.$post->neib.', '.$post->town.'</h6>
</div>
<div class="interaction">
</div>
<br>
<div class="container   interaction">
';

foreach($showcmnt AS $cmnts){
    $showuser = $conn->prepare("SELECT * FROM users WHERE id=:id ");
    $showuser->bindParam("id",$cmnts['userid']);
    $showuser->execute();
    echo'
    <h5><span class="fas fa-user-alt">';
    if($_SESSION["name"]==$adkey){
        echo '  '.$showuser->fetchObject()->name.' :</span> ';
    }else {
        echo ' '.$lang["anony"].':</span> ';
    }
    echo $cmnts['cmnt'];
    if ($cmnts['userid'] == $id OR $_SESSION["name"]==$adkey) {
        echo '   <a href="post.php?id='.$post->id.'&delete='.$cmnts['id'].'" class="trashcan"><span class="fas fa-trash-alt"></span></a>';
    }
    echo '<hr class="cmntline">';    
}

echo '
    </div>';

if (isset($_SESSION["name"])) {
    echo '
<div class="container">
<form method="post" action="post.php?id='.$post->id.'" >
<br><input type="text" name="cmnt" class="form-control" placeholder="'.$lang["tcmnt"].'" required> 
<div class="container interaction">
<button name="submit" class="btn btn-primary"><span class="fas fa-comment"></span>'.$lang["add"].'</button>
</form><br>';
} else {
    echo '<br><a href="login.php"> <div class="alert text-center alert-warning">
    ';
    echo $lang["elog"].'    </div></a>';
}


$cmnt = filter_var($_POST['cmnt'], FILTER_SANITIZE_STRING);
if(isset($_POST['submit'])) {

 $addcmnt = $conn->prepare("INSERT INTO cmnts(userid,postid,cmnt) 
 VALUES(:userid,:postid,:cmnt)");
 $addcmnt->bindParam("userid",$id);
 $addcmnt->bindParam("postid",$post->id);
 $addcmnt->bindParam("cmnt",$cmnt);
 $cmntcheck = $conn->prepare("SELECT * FROM cmnts WHERE userid = :userid AND cmnt = :cmnt  AND postid=:postid");
 $cmntcheck->bindParam("userid",$id);
 $cmntcheck->bindParam("postid",$post->id);
 $cmntcheck->bindParam("cmnt",$cmnt);
 $cmntcheck->execute();
 if ($cmntcheck->rowCount() > 0) {
    echo' <br>  <div class="alert text-center alert-danger">';
    echo $lang["rcmnt"].'</div>';
 } else {

    if($addcmnt->execute()) {
        header("Refresh:0");
    }
 }
 
} 



/*delete page*/

if(isset($_GET["delete"])) {

    $dcmnt = $conn->prepare("DELETE FROM cmnts WHERE id=:id AND userid=:userid AND postid=:postid"); 
    $dcmnt->bindParam("id",$did);   
    $dcmnt->bindParam("userid",$id);   
    $dcmnt->bindParam("postid",$post->id);  
     
    if ($ccmnt->userid == $id ) {
   
        if($dcmnt->execute()) {
            header('Location: post.php?id='.$post->id);
        }

    } else {
        header('Location: index.php');
    }


}


?>
</div>
</div>
<?php
include("./temp/footer.php");
?>
</html>

<?php 
$did=$_GET['delete'];
$title="Home";
session_start();
include('./temp/header.php'); 
include('conn.php'); 

?>

<div class="centerindex">

<div class="container-fluid">
<div class="row-fluid">
<div class="span12">


        
    <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">
 

<?php

$showpost = $conn->prepare("SELECT * FROM post");
$showpost->execute(); 
$pe = $conn->prepare("SELECT id FROM post ORDER BY id ASC LIMIT 1");
$pe->execute();
$pen = $pe->fetchObject()->id ;
foreach($showpost AS $post ) {

$showname = $conn->prepare("SELECT * FROM users WHERE id=:id");
$showname->bindParam("id",$post["userid"]);
$showname->execute();

    echo'
<div class="item ';
if($post["id"] == $pen ) {
    echo 'active';
}
echo '">        
<div class="boxx"> 
<h5>';
if($_SESSION["name"]==$adkey){
echo'<span style="color:red; font-weight:bold;">'.$showname->fetchObject()->name.' : </span>';
}

echo $post["text"].'
</h5>
<img style="cursor:pointer" onclick="onClick(this)" class="postimg" src="pics/'.$post["img"].'" alt="" srcset=""> 
<h6 class="location"> <span class="fas fa-location-arrow"></span> '.$post['neib'].', '.$post["town"].'</h6>
</div>
<div class="interaction">
<a href="post.php?id='.$post["id"].'"><button class="btn btn-primary"><span class="fas fa-comments">
</span>'; 
echo $lang["cmntbtn"];
echo ' </button></a>
<a  target="_blank"  href="https://www.facebook.com/sharer.php?u=https://dreamtn.ml/post.php?id='.$post["id"].'"><button class="btn btn-info"><span class="fas fa-share">
</span> ';
echo $lang["sharebtn"];
echo '</button></a>    ';
if ($id == $post['userid'] OR $_SESSION["name"]==$adkey) {
  echo '<a href="index.php?delete='.$post["id"].'"><button class="btn btn-danger"><span class="fas fa-trash-alt"></span> '.$lang["del"].'</button></a>';
}
echo '</div></div>       ';  
}



if (isset($_GET['delete']) ) {

$cpost = $conn->prepare("SELECT * FROM post WHERE id=:id");
$cpost->bindParam("id",$did);
$cpost->execute();
$postc = $cpost->fetchObject();
$dpost = $conn->prepare("DELETE FROM post WHERE id=:id");
$dpost->bindParam("id",$did);

if ($id == $postc->userid OR $_SESSION["name"]==$f) {
 
  $cmnts = $conn->prepare("DELETE FROM cmnts WHERE postid=:postid");
  $cmnts->bindParam("postid",$did);
  $cmnts->execute();
  if($dpost->execute()){
    header('Location: index.php');
  } else{
    header('Location: index.php');
  } 

} else {
  header('Location: index.php');
}}




?>
        </div>
        <div class="control-box">                            
            <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
            <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
        </div> 
                              
    </div>
        
</div>         
</div> 
</div>

<a href="addpost.php" class="float">
<i class="fa fa-plus my-float"></i>
</a>
<div class="label-container">
<div class="label-text"><?php echo $lang["addcom"]; ?></div>
<i class="fa fa-play label-arrow"></i>
</div>

<div id="modal01" class="w3-modal" onclick="this.style.display='none'">
  <div class="w3-modal-content w3-animate-zoom">
    <img id="img01" style="width:100%">
  </div>
</div>
<script>
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
</script>   
<?php 
include('./temp/footer.php'); 
include('./temp/copyright.php'); 
?>
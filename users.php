<?php
$did=$_GET["delete"];
$title="Users";
session_start();
include('./temp/header.php'); 
include('conn.php'); 
if (!isset($_SESSION["name"]) OR $_SESSION["name"] !== $adkey ){
    header('Location: admin.php');
  }

?>
<div class="container">
    <h1 class="text-center">Users</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">State</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
  $users = $conn->prepare("SELECT * FROM users");
  $users->execute();

 foreach($users AS $user) {

echo '  <tr>
<th scope="row">'.$user["id"].'</th>
<td>'.$user["name"].'</td>
<td>'.$user["state"].'</td>
<td><a href="users.php?delete='.$user["id"].'"><span class="fas fa-trash-alt trashcan"></span></a></td>
</tr>';

 }
 if(isset($_GET["delete"])) {

    $dcmnt = $conn->prepare("DELETE FROM users WHERE id=:id "); 
    $dcmnt->bindParam("id",$di);   
    
   
        if($dcmnt->execute()) {
            header('Location: users.php');
        }

}
  
   ?>
  </tbody>
</table>
</div>



<?php 
include('./temp/footer.php'); 
?>
</html>

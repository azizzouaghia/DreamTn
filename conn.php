<?php

$adkey = '&G7k.T.:<Tr36fM;';

session_start();
$conn= new PDO("mysql:host=; dbname=","","");
$getuserid = $conn->prepare("SELECT id FROM users WHERE name = :name");
$getuserid->bindParam("name",$_SESSION["name"]);
$getuserid->execute();

$id= $getuserid->fetchObject()->id;




?>
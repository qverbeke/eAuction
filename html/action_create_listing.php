<?php
//allow errors to be displayed
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'connect-to-database.php';

$action = $_POST["action"];
if($action == "book"){
  $isbn = $_POST["select-book"];
  $price = $_POST["book-price"];
  $quality = $_POST["select-quality"];
  echo "{$isbn} {$price} {$quality}";
  exit();
}
else if($action =="doc"){
  exit();
}
else{
  echo "illegal action";
  exit();
}

 ?>

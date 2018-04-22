<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'connect-to-database.php';
$username = $_POST["username1"];
$username = trim(preg_replace('/\s\s+/', ' ', $username));
$rating = $_POST["rating1"];
$rated = $_POST["rated"];
$sql_statement = "SELECT UU.UID FROM User_Username UU
WHERE UU.Username=\"{$username}\"";
$result = mysqli_query($conn, $sql_statement);
if(!$result){
  echo $sql_statement;
  echo 'Could not run query: ' . mysqli_error($conn);
}
$row = mysqli_fetch_row($result);
$other_uid = $row[0];
$uid = $_SESSION["UID"];
if ($rated == "Seller"){
  $sql_statement = "INSERT INTO User_Rates_User
  (Seller_UID, Buyer_UID, Rating, Rated)
  VALUES({$other_uid}, {$uid}, {$rating}, \"{$rated}\")";
}else{
  $sql_statement = "INSERT INTO User_Rates_User
  (Seller_UID, Buyer_UID, Rating, Rated)
  VALUES({$uid}, {$other_uid}, {$rating}, \"{$rated}\")";
}
$result = mysqli_query($conn, $sql_statement);

if(!$result){
  echo $sql_statement;
  echo 'Could not run query: ' . mysqli_error($conn);
}
?>

<?php
//allow errors to be displayed
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'connect-to-database.php';
//get username and password
//Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);

if($confirm_password != $password){
  printf("confirm password not the same as password");
}
//placeholder for DOB bc we dont have it yet

$DOB = "99/99/99";
$gender = 1;
$address = "abbey lane";
/*if(empty($username) || empty($password) ) {
	header("Location: index.php?signup=empty");
	exit();
}*/
/*
$sql_statement = "SELECT * FROM Users U WHERE U.username = $username OR U.email = $email";
$result = mysqli_query($conn, $sql_statement);
//if there is someone with the username or email
if(mysqli_num_rows($result) != 0){
  echo "There is someone with the same username or email already in our database";
}
echo "Done";*/

$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
$sql_statement = "INSERT INTO User(Password, DOB, Address, Gender) VALUES ('$password', '$DOB', '$address', '$gender');";
mysqli_query($conn, $sql_statement);
$err = mysqli_error($conn);
echo $err;
/*if(mysqli_num_rows($result) != 0){
  echo "There is someone with that username";
}*/
?>

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
$DOB = mysqli_real_escape_string($conn, $_POST['DOB']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);


//Make gender into a number
if($gender == "male" || $gender == "Male"){
  $gender_num = 0;
}
else if($gender == 'female' || $gender == 'Female'){
  $gender_num = 1;
}else{
  $gender_num = 2;
}

//If the two passwords dont match, reload the page.
if($confirm_password != $password){
  header("Location: index.php?error=incorrect_confirm_password");
  exit();
}

//Check if anyone has the same username or the same email as this new use
$sql_statement = "SELECT * FROM User_Username UU, User_Email UE  WHERE UU.username = '$username' OR UE.email = '$email';";
$result = mysqli_query($conn, $sql_statement);
if(mysqli_num_rows($result) != 0){
  //reload the page and exit the script
  header("Location: index.php?error=duplicate_username_or_email");
  exit();
}
//Encrypt the password
$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
$sql_statement = "INSERT INTO User(Password, DOB, Address, Gender, Phone)
VALUES ('$hashed_pwd', '$DOB', '$address', '$gender_num', '$phone_number');";
mysqli_query($conn, $sql_statement);
//Get the uid from the last insert statement
$UID = mysqli_insert_id($conn);
$sql_statement = "INSERT INTO User_Username(UID, Username) VALUES ('$UID', '$username');";
mysqli_query($conn, $sql_statement);
$sql_statement = "INSERT INTO User_Email(UID, Email) VALUES ('$UID', '$email');";
mysqli_query($conn, $sql_statement);
$sql_statement = "INSERT INTO Seller(UID, Seller_rating)
VALUES({$UID}, 2.5);";
mysqli_query($conn, $sql_statement);
$sql_statement = "INSERT INTO Buyer(UID, Buyer_rating)
 VALUES (\"{$UID}\", 2.5);";
mysqli_query($conn, $sql_statement);
$_SESSION["UID"] = $UID;
$_SESSION["username"] = $username;
//go to the main pag
header("Location: home.php?status=register_success");

?>

<?php
  //must include this when we use the database
  include_once 'connect-to-database.php';

  //get username and password from the form
  $username = $_POST["username"];
  $password = $_POST["password"];

  $_SESSION["username"] = $username;

  //See if there are any users that have this username
  $sql_statement = "SELECT UU.UID FROM User_Username UU WHERE UU.username='$username'";
  $result = mysqli_query($conn, $sql_statement);

  //if error or no usernames
  if (!$result || mysqli_num_rows($result) == 0) {
    //reload the page with different erro
    header("Location: login.php?error=username_not_found");
    //stop running script
    exit();
  }
  //get the result in an array
  $row = mysqli_fetch_row($result);
  //get the users ID
  $UID = $row[0];
  $_SESSION["UID"] = $UID;
  //Look for password for the user with the UID determined above
  $sql_statement = "SELECT U.password FROM User U WHERE U.UID='$UID'";
  $result = mysqli_query($conn, $sql_statement);
  if (!$result) {
    echo 'Could not run query: ' . mysqli_error();
    exit();
  }
  //get the result of query as a hashed password
  $row = mysqli_fetch_row($result);
  $hashed_password = $row[0];
  //Check if the passwords are equal
  if(!password_verify($password,$hashed_password)){
    //reload page with incorrect password message
    header("Location: login.php?error=incorrect_password");
    exit();
  }
  header("Location: home.php?status=sign_in_success");
  exit();
 ?>

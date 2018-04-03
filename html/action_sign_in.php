<?php
  include_once 'connect-to-database.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql_statement = "SELECT UU.UID FROM User_Username UU WHERE UU.username='$username'";
  $result = mysqli_query($conn, $sql_statement);
  if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: login.php?error=username_not_found");
    exit();
  }
  $row = mysqli_fetch_row($result);
  $UID = $row[0];

  $sql_statement = "SELECT U.password FROM User U WHERE U.UID='$UID'";
  $result = mysqli_query($conn, $sql_statement);
  if (!$result) {
    echo 'Could not run query: ' . mysqli_error();
    exit();
  }
  $row = mysqli_fetch_row($result);
  $hashed_password = $row[0];
  if(!password_verify($password,$hashed_password)){
    header("Location: login.php?error=incorrect_password");
    exit();
  }
  header("Location: index.php?status=sign_in_success");
  $dochtml = new DOMDocument();
  $dochtml->loadHTMLFile('login.php');
  $elm = $dochtml->getElementById('error-text');
  $elm->nodeValue = "HELLO";
  exit();

 ?>

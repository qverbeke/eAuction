<?php
//start a session so that we can keep variables across pages
session_start();
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "BetterBookstore";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if(!$conn){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>

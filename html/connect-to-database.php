<?php
//start a session so that we can keep variables across pages
session_start();
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "zPp>v\/16S,DO*";
$dbName = "betterbookstore";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if(!$conn){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>

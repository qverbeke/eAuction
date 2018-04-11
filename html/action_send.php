<?php
//allow errors to be displayed
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'connect-to-database.php';

$to = $_POST["to"];
$message = $_POST["message"];
$action = $_POST["action"];
echo $to . $message . $action;


?>

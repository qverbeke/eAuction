<?php
include_once 'connect-to-database.php';
session_start();
$ISBN = $_POST['ISBN'];
$PRICE= $_POST['Price'];
$query = "INSERT INTO Buyer_Wants_Book(ISBN, UID, Timestamp, Desired_price) VALUES('".$ISBN."', ".$_SESSION['UID'].", CURRENT_TIMESTAMP, ".$PRICE.");";
mysqli_query($conn, $query);
header( "Location:book_page.php?ISBN=".$ISBN);
?>

<?php
include_once 'connect-to-database.php';
$ISBN = $_GET['ISBN'];
$PRICE= $_GET['Price'];
$query = "INSERT INTO Buyer_Wants_Book(ISBN, UID, Timestamp, Desired_price) VALUES('".$ISBN."', ".$_SESSION['UID'].", CURRENT_TIMESTAMP, ".$PRICE.");";
mysqli_query($conn, $query);
header( "Location:book_page.php?ISBN=".$ISBN);
?>

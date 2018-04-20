<?php
include_once 'connect-to-database.php';
$ISBN = $_POST['ISBN'];
$query = "DELETE FROM Buyer_Wants_Book WHERE UID=".$_SESSION["UID"]." AND ISBN='".$ISBN."';";
mysqli_query($conn, $query);
header( "Location:book_page.php?ISBN=".$ISBN);
?>

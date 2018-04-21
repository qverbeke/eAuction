<?php
include_once 'connect-to-database.php';
$LID = $_POST['LID'];
$query = "DELETE FROM Listing WHERE LID=".$LID.";";
mysqli_query($conn, $query);
header( "Location:manage_listings.php");
?>

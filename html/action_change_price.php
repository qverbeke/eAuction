<?php
include_once 'connect-to-database.php';
$LID=$_POST['LID'];
$Price=$_POST['Price'];
$query="UPDATE Listing SET Price=".$Price." WHERE LID=".$LID.";";
mysqli_query($conn, $query);
?>

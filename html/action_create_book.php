<?php
include_once 'connect-to-database.php';
$test_query="Select * FROM Book WHERE ISBN=".$_GET["ISBN"].";";
$result=mysqli_query($conn, $query);
if($exists= mysqli_fetch_assoc($result)){
	header("Location:add_book.php");
}
else{
	$query="INSERT INTO Book_Name_Desc_Key(Name, Description, MyKeys) VALUES('".$_GET["Title"]."', '".$_GET["Description"]."', '".$_GET["Keywords"]."');";
	mysqli_query($conn, $query);
	$query="INSERT INTO Book(ISBN, Name, Description, ImgURL) VALUES('".$_GET["ISBN"]."', '".$_GET["Title"]."', '".$_GET["Description"]."', '".$_GET["ImgURL"]."');";
	mysqli_query($conn, $query);
	$query="INSERT INTO Book_NAE(ISBN, Author, Edition) VALUES('".$_GET["ISBN"]."', '".$_GET["Author"]."', ".$_GET["Edition"].");";
	mysqli_query($conn, $query);
	header( "Location:create_listing.php");
}





?>

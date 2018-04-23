<?php
include_once 'connect-to-database.php';
$test_query="Select * FROM Book WHERE ISBN=".$_POST["ISBN"].";";
$result=mysqli_query($conn, $test_query);
if($exists= mysqli_fetch_assoc($result)){
	header("Location:add_book.php");
}
else{
	mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
	$query="INSERT INTO Book_Name_Desc_Key(Name, Description, MyKeys) VALUES('".addslashes($_POST["Title"])."', '".addslashes($_POST["Description"])."', '".addslashes($_POST["Keywords"])."');";
	if(!mysqli_query($conn, $query)){
		mysqli_rollback($conn);		
	}
	$query="INSERT INTO Book(ISBN, Name, Description, ImgURL) VALUES('".$_POST["ISBN"]."', '".addslashes($_POST["Title"])."', '".addslashes($_POST["Description"])."', '".$_POST["ImgURL"]."');";
	if(!mysqli_query($conn, $query)){
		mysqli_rollback($conn);			
	}
	$query="INSERT INTO Book_NAE(ISBN, Author, Edition) VALUES('".$_POST["ISBN"]."', '".addslashes($_POST["Author"])."', ".$_POST["Edition"].");";
	if(!mysqli_query($conn, $query)){
		mysqli_rollback($conn);			
	}
	mysqli_commit($conn);	
	mysqli_close($conn);
	header( "Location:create_listing.php");
}





?>

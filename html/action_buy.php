<?php
include_once 'connect-to-database.php';
session_start();
$Buyer_UID=$_SESSION['UID'];
if(isset($_POST["Buyer_UID"])){
	$Buyer_UID=$_POST["Buyer_UID"];
}
$Online_or_live=0;
if(isset($_POST["live"])){
	$Online_or_live=1;
}
$LID=$_POST['LID'];
mysqli_begin_transaction($conn);
$query="INSERT INTO Transaction(Online_or_live, Timestamp, CC_info, LID, Buyer_UID) VALUES(".$Online_or_live.", CURRENT_TIMESTAMP, 'no info', ".$LID.", ".$Buyer_UID.");";
$res = mysqli_query($conn, $query);
if(!$res){
	mysqli_rollback($conn);
}
if($_POST["trans_type"]=="book"){
	if($_POST["Price"]<$_POST["Min_price_ever"]){
		$query="UPDATE Book SET Min_price_ever=".$_POST["Price"]." WHERE ISBN=".$_POST["ISBN"].";";
		$res = mysqli_query($conn, $query);
		if(!$res){
			mysqli_rollback($conn);
		}
	}
	if($_POST["Price"]>$_POST["Max_Price_Ever"]){
		$query="UPDATE Book SET Max_Price_Ever=".$_POST["Price"]." WHERE ISBN=".$_POST["ISBN"].";";
		$res = mysqli_query($conn, $query);
		if(!$res){
			mysqli_rollback($conn);
		}
	}
	$query="UPDATE Book SET Qty_sold=".(string)((int)$_POST["Qty_sold"]+1)." WHERE ISBN=".$_POST["ISBN"].";";
	$res = mysqli_query($conn, $query);
	if(!$res){
		mysqli_rollback($conn);
	}
	$query="UPDATE Book SET Avg_price=".(string)((((int)$_POST["Qty_sold"]*(int)$_POST["Qty_sold"])+(int)$_POST["Price"])/((int)$_POST["Qty_sold"]+1))." WHERE ISBN=".$_POST["ISBN"].";";
	$res = mysqli_query($conn, $query);
	if(!$res){
		mysqli_rollback($conn);
	}
	mysqli_commit($conn);
	mysqli_close($conn);
	header("Location:home.php");
}
elseif($_POST["trans_type"]=="coursedoc"){
	$query = "UPDATE Course_Doc_Listing SET Qty_sold=".((int)$_POST["Qty_sold"]+1)." WHERE LID=".$LID.";";
	$res = mysqli_query($conn, $query);
	if(!$res){
		mysqli_rollback($conn);
	}
	mysqli_commit($conn);
	mysqli_close($conn);
	header("Location:home.php");
}
else{
	exit(1);
}

?>

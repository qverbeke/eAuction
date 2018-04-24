<?php
include_once 'connect-to-database.php';
session_start();
$input_type=$_POST["changing"];
$input_val=$_POST["newval"];
if($input_type=="Username"){
	$query="SELECT * FROM User_Username WHERE Username='".$input_val."';";
	$result=mysqli_query($conn, $query);
	if(mysqli_num_rows($result)==0){
		$query="UPDATE User_Username SET Username='".$input_val."' WHERE UID=".$_SESSION["UID"].";";
		$result=mysqli_query($conn, $query);
		if(!$result){
			echo "Update failed";
		}
		else{
			echo "Username changed to: ".$input_val;
		}
		
	}
	else{
		echo "Username already in use";
	}
}
elseif($input_type=="Email"){
	$query="SELECT * FROM User_Email WHERE Email='".$input_val."';";
	$result=mysqli_query($conn, $query);
	if(mysqli_num_rows($result)==0){
		$query="UPDATE User_Email SET Email='".$input_val."' WHERE UID=".$_SESSION["UID"].";";
		$result=mysqli_query($conn, $query);
		if(!$result){
			echo "Update failed";
		}
		else{
			echo "Email changed to: ".$input_val;
		}
		
	}
	else{
		echo "Email already in use";
	}
}
elseif($input_type=="Phone"){
	$query="UPDATE User SET Phone='".$input_val."' WHERE UID=".$_SESSION["UID"].";";
	$result=mysqli_query($conn, $query);
	if(!$result){
		echo "Update failed";
	}
	else{
		echo "Phone changed to: ".$input_val;
	}
}
elseif($input_type=="Address"){
	$query="UPDATE User SET Address='".$input_val."' WHERE UID=".$_SESSION["UID"].";";
	$result=mysqli_query($conn, $query);
	if(!$result){
		echo "Update failed";
	}
	else{
		echo "Address changed to: ".$input_val;
	}
}
elseif($input_type=="Willing_to_meet"){
	$query="UPDATE Seller SET Willing_to_meet=";
	if($input_val=="Yes"){
		$query=$query."0";
		echo "No";
	}
	else{
		$query=$query."1";
		echo "Yes";
	}
	$query=$query." WHERE UID=".$_SESSION["UID"].";";
	$result=mysqli_query($conn, $query);
	if(!$result){
		echo "Error, this should never happen. Oops";
	}
}
else{
	exit(1);
}

?>

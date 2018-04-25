<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=account");
}
?>
<!DOCTYPE html>
<html>
	<head>
	  <title>The Better Bookstore</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <link rel="stylesheet" href="styles/misc.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <script>
		$(document).ready(function(e){
			$('#navbar').load("navbar.html");
		});
	  </script>
	  <script>
	  function editval(varname){
		var orig = document.getElementById(varname).innerHTML;	    
		document.getElementById(varname).innerHTML = "<input type='text' id='"+varname+"-input'>";
		var myelem = document.getElementById(varname+"-btn");
		myelem.innerHTML="Save";
		myelem.setAttribute("onclick", "javascript: changeval('"+varname+"', '"+orig+"'); return false;");
		return false;
	  }
	  function changeval(varname, orig){
			var inputval=document.getElementById(varname+"-input").value;
			$.post(
				"action_modify_account.php",
				{
					changing: varname,
					newval: inputval
				},
				function(data, status){
					alert(data);
					if(data.indexOf(varname+" changed to:")!=-1){
						document.getElementById(varname).innerHTML=data.substring(varname.length+13);
					}
					else{
						document.getElementById(varname).innerHTML=orig;
					}
					myelem=document.getElementById(varname+"-btn")
					myelem.innerHTML="Edit";
					myelem.setAttribute("onclick", "javascript: editval('"+varname+"'); return false;");
				}
			);
			return false;
	  }
	  function willingchange(){
			var willingval=document.getElementById("Willing").innerHTML;
			$.post(
				"action_modify_account.php",
				{
					changing: "Willing_to_meet",
					newval: willingval
				},
				function(data, status){
					alert("Value toggled to "+data+".");
					document.getElementById("Willing").innerHTML=data;
				}
			);
	  
	  
	  }
	  
	  
	  
	  </script>
	</head>
<body style="background-color:#00cc7a;">
<div id="navbar" style="margin-top:50px;"></div>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8" style="background-color:white;padding-top:20px;padding-bottom:20px; border-radius:10px;">
			<h2>Account information</h2>
			<?php
			include_once 'connect-to-database.php';
			$query="SELECT * FROM User U, User_Username UU, User_Email E, Seller S, Buyer B WHERE U.UID=UU.UID AND U.UID=E.UID AND U.UID=S.UID AND U.UID=B.UID AND U.UID=".$_SESSION["UID"].";";
			$result=mysqli_query($conn, $query);
			if($user_info=mysqli_fetch_assoc($result)){
				echo "
				<div class='row'>
					<div class='col-sm-5'>
						<h3>Username:</h3>
					</div>
					<div class='col-sm-5'>
						<h3 id='Username'>".$user_info["Username"]."</h3>
					</div>
					<div class='col-sm-2'>
						<button id='Username-btn' class='btn btn-primary' style='float:left; width:100%; margin-top:15px;' onclick='editval(\"Username\"); return false;'>Edit</button>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-5'>
						<h3>Email:</h3>
					</div>
					<div class='col-sm-5'>
						<h3 id='Email'>".$user_info["Email"]."</h3>
					</div>
					<div class='col-sm-2'>
						<button id='Email-btn' class='btn btn-primary' style='float:left; width:100%; margin-top:15px;' onclick='editval(\"Email\"); return false;'>Edit</button>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-5'>
						<h3>Phone:</h3>
					</div>
					<div class='col-sm-5'>
						<h3 id='Phone'>".$user_info["Phone"]."</h3>
					</div>
					<div class='col-sm-2'>
						<button id='Phone-btn' class='btn btn-primary' style='float:left; width:100%; margin-top:15px;' onclick='editval(\"Phone\"); return false;'>Edit</button>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-5'>
						<h3>Address:</h3>
					</div>
					<div class='col-sm-5'>
						<h3 id='Address'>".$user_info["Address"]."</h3>
					</div>
					<div class='col-sm-2'>
						<button id='Address-btn' class='btn btn-primary' style='float:left; width:100%; margin-top:15px;' onclick='editval(\"Address\"); return false;'>Edit</button>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-5'>
						<h3>Willing to meet:</h3>
					</div>
					<div class='col-sm-5'>
						<h3 id='Willing'>";
						if($user_info["Willing_to_meet"]==0){
							echo "No"; 
						}
						else{
							echo "Yes";
						}
						echo "</h3>
					</div>
					<div class='col-sm-2'>
						<button class='btn btn-primary' style='float:left; width:100%; margin-top:15px;' onclick='willingchange(); return false;'>Toggle</button>
					</div>
				</div>
				<hr>
				<div class='row'>
					<div class='col-sm-6'>
						<h3>Date of Birth:</h3>
					</div>
					<div class='col-sm-6'>
						<h3>".$user_info["DOB"]."</h3>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-6'>
						<h3>Gender:</h3>
					</div>
					<div class='col-sm-6'>
						<h3>";
						if($user_info["Gender"]==0){
							echo "Male";
						}
						elseif($user_info["Gender"]==1){
							echo "Female";
						}
						else{
							echo "Other";
						}
						echo "</h3>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-6'>
						<h3>Seller Rating:</h3>
					</div>
					<div class='col-sm-6'>";
						for ($j=0; $j<floor(floatval($user_info["Seller_rating"])); $j=$j+1){
							echo "<img src='img/star.png' style='white-space: nowrap; width:20px; margin-bottom:-20px'>";
						}
						echo "<h3>".$user_info["Seller_rating"]."/5 stars</h3>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-6'>
						<h3>Buyer Rating:</h3>
					</div>
					<div class='col-sm-6'>
						";
						for ($j=0; $j<floor(floatval($user_info["Buyer_rating"])); $j=$j+1){
							echo "<img src='img/star.png' style='white-space: nowrap; width:20px; margin-bottom:-20px'>";
						}
						echo "<h3>".$user_info["Buyer_rating"]."/5 stars</h3>
					</div>
				</div>			
				";
				
				
				
			
			}
			?>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
</body>
</html>

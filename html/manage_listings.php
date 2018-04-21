<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=manage_listings");
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
		$('.search-panel .dropdown-menu').find('a').click(function(e) {
			e.preventDefault();
			var param = $(this).attr("href").replace("#","");
			var concept = $(this).text();
			$('.search-panel span#search_concept').text(concept);
			$('.input-group #search_param').val(param);
		});
	});
  </script>
  <script>
  function changePrice(LID){
	var myelem = document.getElementById("l"+LID);
	myelem.innerHTML="<h5>New Price:</h5>$<input type='number' id='in"+LID+"' step='0.01' min='0.01' style='width:6em'><button onclick='submitPrice("+LID+"); return false;'>Submit</button>";
	return false;
  }
  function submitPrice(myLID){
	var newPrice=document.getElementById("in"+myLID).value;
	$.post( "action_change_price.php", { LID: myLID+"", Price: newPrice+""});
	document.getElementById("l"+myLID).innerHTML="<h3><b>Price</b>:<br>$"+newPrice+"</h3>";
	return false; 
  }
  
  </script>
</head>
<body style="background-color:#00cc7a;">
<div id="navbar" style="margin-top:50px;">
</div>
<div class="container-fluid with-navbar">
	<div class="container-fluid" >
		<div class="container-fluid" style="width:100%; border-radius:10px; background-color:white; width:50%; text-align:center;"><h1><b>My Book Listings</b></h1></div>
		<?php
			include 'connect-to-database.php';
			$query="SELECT L.Timestamp, B.Name, B.ISBN, L.LID, L.Price FROM Listing L, Book_Listing BL, Book B WHERE L.LID=BL.LID AND L.Seller_UID=".$_SESSION["UID"]." AND BL.ISBN=B.ISBN;";
			$result=mysqli_query($conn, $query);
			while($list_info = mysqli_fetch_assoc($result)){
				$time = strtotime($list_info["Timestamp"]);
				$myFormatForView = date("m/d/y", $time);
				echo "<div class='row' style='height:120px'>
					<div class='col-sm-9' style='height: 100%;'>
						<div class='row' style='background-color:white; height:90%; margin-top:10px;margin-bottom:10px; border-radius:10px'>
							<div class='col-sm-4'>
								<h3><b>Title</b>: ".$list_info["Name"]."</h3>
								<h5><b>ISBN</b>: ".$list_info["ISBN"]."</h5>
							</div>
							<div class='col-sm-3'>
								<h3><b>Listing ID</b>: ".$list_info["LID"]."</h3>
							</div>
							<div class='col-sm-3'>
								<h3><b>Date created</b>: ".$myFormatForView."</h3>
							</div>
							<div class='col-sm-2'>
								<div id='l".$list_info["LID"]."'><h3><b>Price</b>:<br>$".$list_info["Price"]."</h3></div>
							</div>
						</div>
					</div>
					<div class='col-sm-3' style='background-color:white; height:90%; margin-top:10px;margin-bottom:10px; border-radius:10px; margin-left:10px; margin-right:-10px; padding-top:10px; padding-bottom:10px'>
							<button onclick='changePrice(".$list_info["LID"]."); return false;' class='btn' style='width:50%; height:100%; font-size:24px; float:left; background-color:#BFBFBF'>Change<br>Price</button>
							<form action='action_delete_listing.php' method='post' style='height:100%; width:50%; float:left;'>
								<button type='submit' class='btn btn-primary' style='width:100%; height:100%; font-size:24px;'>Delete<br>Listing</button>
								<input type='hidden' value='".$list_info["LID"]."' name='LID'>
							</form>
					</div>
				</div>
				";
			
			}
		?>
		</div>
		<div class="container-fluid" style="width:100%; border-radius:10px; margin-top:20px; background-color:white; width:50%; text-align:center;"><h1><b>My Course Doc Listings</b></h1></div>
		<?php
			include 'connect-to-database.php';
			$query="SELECT L.Timestamp, CD.Title, C.Name, C.Professor, L.LID, L.Price, CD.Type, CD.Qty_sold FROM Listing L, Course_Doc_Listing CD, Course_Doc_Part_Of_Course P, Course C WHERE L.LID=CD.LID AND L.Seller_UID=".$_SESSION["UID"]." AND CD.LID=P.LID AND P.CID=C.CID;";
			$result=mysqli_query($conn, $query);
			while($list_info = mysqli_fetch_assoc($result)){
				$time = strtotime($list_info["Timestamp"]);
				$myFormatForView = date("m/d/y", $time);
				echo "<div class='row' style='height:120px'>
					<div class='col-sm-9' style='height: 100%;'>
						<div class='row' style='background-color:white; height:90%; margin-top:10px;margin-bottom:10px; border-radius:10px'>
							<div class='col-sm-3'>
								<h3><b>Title</b>: ".$list_info["Title"]."</h3>
								<h5><b>Type</b>: ".$list_info["Type"]."</h5>
							</div>
							<div class='col-sm-3'>
								<h3><b>Course Name</b>: ".$list_info["Name"]."</h3>
								<h5><b>Professor</b>: ".$list_info["Professor"]."</h5>
							</div>
							<div class='col-sm-3'>
								<h3><b>Listing ID</b>: ".$list_info["LID"]."</h3>
								<h5><b>Date created</b>: ".$myFormatForView."</h5>
							</div>
							<div class='col-sm-3'>
								<div id='l".$list_info["LID"]."'><h3><b>Price</b>:<br>$".$list_info["Price"]."</h3></div>
								<h5><b>Qty Sold</b>:".$list_info["Qty_sold"]."</h5>
							</div>
						</div>
					</div>
					<div class='col-sm-3' style='background-color:white; height:90%; margin-top:10px;margin-bottom:10px; border-radius:10px; margin-left:10px; margin-right:-10px; padding-top:10px; padding-bottom:10px'>
							<button onclick='changePrice(".$list_info["LID"]."); return false;' class='btn' style='width:50%; height:100%; font-size:24px; float:left; background-color:#BFBFBF'>Change<br>Price</button>
							<form action='action_delete_listing.php' method='post' style='height:100%; width:50%; float:left;'>
								<button type='submit' class='btn btn-primary' style='width:100%; height:100%; font-size:24px;'>Delete<br>Listing</button>
								<input type='hidden' value='".$list_info["LID"]."' name='LID'>
							</form>
					</div>
				</div>
				";
			
			}
		?>
	</div>
</div>
</body>		
</html>

<!DOCTYPE html>
<html lang="en">
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
</head>
<body>
<div id="navbar" style="margin-top:50px;">
</div>
<div class="container-fluid with-navbar">
	<div class="container-fluid" style="background-color:#00cc7a; padding-top:20px;padding-bottom:20px; border-radius:10px">
		<div class="container-fluid">
			<form action="/list_page.php">
				<div class="input-group">
					<div class="input-group-btn search-panel">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="margin-top:-10px">
							<span id="search_concept">Search by</span> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
						  <li><a href="#Title">Title</a></li>
						  <li><a href="#Author">Author</a></li>
						  <li><a href="#ISBN">ISBN</a></li>
						  <li class="divider"></li>
						  <li><a href="#Prof">Professor</a></li>
						  <li><a href="#Course Name">Course Name</a></li>
						  <li><a href="#Group">Major/College</a></li>
						</ul>
					</div>
					<input type="hidden" name="search_param" value="Title" id="search_param">
					<input type="text" class="form-control" name="search_term" placeholder="Search term...">
					<span class="input-group-btn">
						<input class="btn btn-default" type="submit" value="Search">
					</span>
				</div>
			</form>
		</div>
		<hr>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-7">
					<?php
					include_once 'connect-to-database.php';				
					$query_piece="";
					$LID=$_GET['LID'];
					$query="SELECT L.Price, CD.Type, CD.Description, CD.Title, CD.Qty_sold, C.Name, C.Professor, C.CID FROM Listing L, Course_Doc_Listing CD, Course_Doc_Part_Of_Course P, Course C WHERE L.LID=".$LID." AND L.LID=CD.LID AND CD.LID=P.LID AND P.CID=C.CID";
					$result=mysqli_query($conn, $query);
					$doc_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo "<div class=\"container-fluid\" style=\"background-color:white; margin:10px 10px 10px 10px; border-radius: 10px\">
						<h1>".$doc_info["Title"]."</h1>
						<h3>".$doc_info["Type"]."</h3>
						<h3>".$doc_info["Price"]."</h3>
						<h4>Quantity Sold: ".$doc_info["Qty_sold"]."</h4>
						<h5>".$doc_info["Description"]."</h3>
						<h3>".$doc_info["Name"]."</h3>
						<h3>".$doc_info["Professor"]."</h3>
						<form method='POST' action='/course_doc_page.php'>
							<input class='btn btn-primary' style='margin-top:6px; width:100%; font-size:24px; margin-top:13px' type='Submit' value='BUY'>
							<input type='hidden' name='LID' value='".$LID."'>
						</form>
					</div>
				</div>
				<div class='col-sm-5'>
					<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px'>
						<h4>Other documents from courses this is used in:</h4>
					</div>";
					$query="SELECT CD.LID, CD.Title, CD.Type, L.Price FROM Listing L, Course_Doc_Listing CD, Course_Doc_Part_Of_Course P WHERE L.LID=CD.LID AND CD.LID=P.LID AND CD.LID!=".$LID." AND P.CID=".$doc_info["CID"].";";
					$result=mysqli_query($conn, $query);
					while($listing_info = mysqli_fetch_assoc($result)){
						echo "<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px'>
							<div class='row'>
								<div class='col-sm-3'>
									<form method='GET' action='/course_doc_page.php'>
										<input class='btn btn-primary' style='margin-top:6px; width:100%; font-size:24px; margin-top:13px' type='Submit' value='VIEW'>
										<input type='hidden' name='LID' value='".$listing_info['LID']."'>
									</form>
								</div>
								<div class='col-sm-5'>
									<h3>Type: <b>".$listing_info['Type']."</b></h3> 
								</div>
								<div class='col-sm-4'>
									<h3>Price: <b>$".$listing_info['Price']."</b></h3>
								</div>
							</div>
						</div>";		
					}
				?>
			</div>
		</div>
	</div>
</body>

</html>

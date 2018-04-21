<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=book_page&ISBN=".$_GET["ISBN"]);
}
?>

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
		<?php
		include_once 'connect-to-database.php';				
		$query_piece="";
		$ISBN=$_GET['ISBN'];
		$query="SELECT * FROM Book B, Book_NAE N, Book_Name_Desc_Key D WHERE B.ISBN='".$ISBN."' AND B.ISBN=N.ISBN AND B.Name=D.Name AND B.Description=D.Description";
		$result=mysqli_query($conn, $query);
		$book_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo "<div class=\"container-fluid\" style=\"background-color:white; margin:10px 10px 10px 10px; border-radius: 10px\">
			<div class=\"row\">
				<div class=\"col-sm-4\" style=\"margin:10px\">
					<img src=\"".$book_info["ImgURL"]."\" style=\"width:100%\">
				</div>
				<div class=\"col-sm-8\" style=\"margin-right:-30px\">
					<div class=\"row\">
						<div class=\"col-sm-7\">
							<h1>".$book_info["Name"]."</h1>
							<h3>".$book_info["Author"]."</h3>
							<h4>Edition: ".$book_info["Edition"]."</h4>
							<h5>".$book_info["Description"]."</h5>
							<h3>Keywords: ";
							$keywords = explode(",", $book_info["MyKeys"]);
							foreach($keywords as $keyword){
								echo "$keyword, ";
							}
					  echo "</h3>
						</div>
						<div class=\"col-sm-5\" style=\"padding-right:20px\">
							<h2>Used in:</h2><hr>";
							$used_query="SELECT C.Name FROM Book B, Course_Uses_Book U, Course C WHERE B.ISBN='".$book_info["ISBN"]."' AND B.ISBN=U.ISBN AND C.CID=U.CID;";
							$used_result=mysqli_query($conn, $used_query);
							while($used_by=mysqli_fetch_assoc($used_result)){
								echo "<h3>".$used_by["Name"]."</h3>";
							}
				 echo "</div>
					</div>
				</div>
			</div>
		</div>";
		$query="SELECT Qty_sold, Avg_price, Min_price_ever, Max_Price_Ever FROM Book WHERE ISBN='".$ISBN."';";
		$result=mysqli_query($conn, $query);
		$meta_info=mysqli_fetch_assoc($result);
		if($meta_info["Qty_sold"]!=0){
			echo "<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px'>
				<h3><b>Some information about the sale of this book:</b></h3>
				<div class='row'>
					<div class='col-sm-3'>
						<h4>Quantity sold:</h4><h2>".$meta_info["Qty_sold"]."</h2>
					</div>
					<div class='col-sm-3'>
						<h4>Average price:</h4><h2>$".$meta_info["Avg_price"]."</h2>
					</div>
					<div class='col-sm-3'>
						<h4>Minimum price ever:</h4><h2>$".$meta_info["Min_price_ever"]."</h2>
					</div>
					<div class='col-sm-3'>
						<h4>Maximum price ever:</h4><h2>$".$meta_info["Max_Price_Ever"]."</h2>
					</div>
				</div>
			</div>";
		}			
		$query="SELECT L.LID, L.Price, BL.Quality, S.Seller_rating FROM Book B, Book_Listing BL, Listing L, Seller S WHERE B.ISBN='".$ISBN."' AND B.ISBN=BL.ISBN AND BL.LID=L.LID AND L.Seller_UID=S.UID AND S.UID!=".$_SESSION["UID"].";";
		$result=mysqli_query($conn, $query);
		while($listing_info = mysqli_fetch_assoc($result)){
			echo "<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px'>
				<div class='row'>
					<div class='col-sm-2'>
						<form method='POST' action='/transaction.php'>
							<input class='btn btn-primary' style='margin-top:6px; width:100%; font-size:24px; margin-top:13px' type='Submit' value='BUY'>
							<input type='hidden' name='LID' value='".$listing_info['LID']."'>
						</form>
					</div>
					<div class='col-sm-3' style='margin-top:4px'>
						<div class='container-fluid'>
							<div class='row'>
								<div class='col-sm-6'>
									<h3 align='right'>Price:</h3>
								</div>
								<div class='col-sm-6'>
									<h3 align='left'><b>$".$listing_info["Price"]."</b></h3>
								</div>
							</div>
						</div>
					</div>
					<div class='col-sm-3' style='margin-top:4px'>
						<div class='container-fluid'>
							<div class='row'>
								<div class='col-sm-6'>
									<h3 align='right'>Quality:</h3>
								</div>
								<div class='col-sm-6'>
									<h3 align='left'><b>".$listing_info["Quality"]."</b></h3>
								</div>
							</div>
						</div>
					</div>
					<div class='col-sm-4'>
						<div class='container-fluid'>
							<div class='row'>
								<div class='col-sm-4' style='margin-top:6px'><h4>Seller Rating:</h4></div>
								<div class='col-sm-8'>";
									for ($j=0; $j<floor(floatval($listing_info["Seller_rating"])); $j=$j+1){
										echo "<img src='img/star.png' style='white-space: nowrap; width:20px; margin-bottom:-20px'>";
									}
								echo "
									<h4 style='padding-top:14px'>".$listing_info["Seller_rating"]."/5 stars</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
		echo "<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px'>";
		$query="SELECT * FROM Buyer_Wants_Book WHERE ISBN='".$ISBN."' AND UID=".$_SESSION["UID"].";";
		$result=mysqli_query($conn, $query);
		if($wish_info = mysqli_fetch_assoc($result)){
			$time = strtotime($wish_info["Timestamp"]);
			$myFormatForView = date("m/d/y", $time);
			echo "<div class='row'>
				<div class='col-sm-9'>
					<h3>This item is already on your wishlist for <b>$".$wish_info["Desired_price"]."</b>. It was added on ".$myFormatForView.".
					 Do you want to delete this from your wishlist?</h3>
				</div>
				<div class='col-sm-3'>
					<form action='/action_remove_wishlist.php' method='POST'>
						<input class='btn btn-primary' type='submit' value='Delete' style='margin-top:6px; width:100%; font-size:24px; margin-top:16px'>
						<input type='hidden' name='ISBN' value='".$ISBN."'>
					</form>
				</div>
			</div>";
		}
		else{
			echo "
				<div class='row'>
				<div class='col-sm-6'>
					<h3>If you would like to keep track of this item, you can add it to the wishlist.</h3>
				</div>
				<div class='col-sm-6'>
					<form action='/action_add_wishlist.php' method='POST'>
						<h4 style='float:left; margin-top:28px'>Price: $</h4>
						<input type='number' name='Price' value='0' step='0.01' min='0' style='font-size:16px; margin-top:20px; width: 6em;'>
						<input class='btn btn-primary' type='submit' value='Add to Wishlist' style='float:right;margin-top:6px; width:50%; font-size:24px; margin-top:16px'>
						<input type='hidden' name='ISBN' value='".$ISBN."'>
					</form>
					</div>
				</div>";
		}
		echo "</div>";
	?>
	</div>
</body>

</html>

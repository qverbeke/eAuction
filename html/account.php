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
<body style="background-color:#00cc7a;">
<div id="navbar" style="margin-top:50px;"></div>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="container-fluid" style="background-color:white;padding-top:20px;padding-bottom:20px; border-radius:10px; text-align:center;">
				<h2>Account Options</h2>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4">
						<a href="create_listing.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>Create Listing</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/list.png" alt="add a listing" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="add_book.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>Add Book</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/add.png" alt="add a listing" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="wishlist.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>View Wishlist</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/wish.png" alt="view wishlist" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4">
						<a href="bought.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>View transaction history</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/books.png" alt="view items" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="feedback.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>Provide feedback</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/feedback.png" alt="provide feedback" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="manage_listings.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>Manage Listings</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/manage.png" alt="Manage listings" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<a href="action_logout.php" style="text-decoration:none;">
							<div class="account-container">
								<h3>Log out</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/logout.png" alt="Logout" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
</body>
</html>

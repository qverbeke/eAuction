<!DOCTYPE html>

<html lang="en">
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/misc.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  //When document has loaded
	$(document).ready(function(e){
    $('#navbar').load("navbar.html");
    //Make an on click function in all a tags descendants of an element with the serach panel class or dropdown menu
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
      //prevent the default action of the event from being triggered
      e.preventDefault();
      //param equals the href field in the specific tag that was clicked minus the #
			var param = $(this).attr("href").replace("#","");
      //Get the text in the a tag
			var concept = $(this).text();
      //Sets text in search panel class and in search concept id in a span to search_concept
			$('.search-panel span#search_concept').text(concept);
      //Sets the value in all classes of input-group and all divs with id search_param to value param
      $('.input-group #search_param').val(param);

		});
	});
	</script>
</head>
<body>
<div id="navbar" style="margin-top:50px;">
</div>
<div class="fluid-container">
	<div class="jumbotron text-center" style="background-color:#00cc7a">
		  <h1 style="color:white"><b>Better Bookstore</b></h1>
		  <p style="color:white">A money-saving marketplace for students</p>
		  <br>
		  <div class="container-fluid" style="width:66%; margin:auto">
			<form action="/list_page.php">
				<div class="input-group">
					<div class="input-group-btn search-panel">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
						<input class="btn btn-default" type="submit" value="Search" style="margin-bottom:0px">
					</span>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4">
					<a href="/create_listing.php" style="text-decoration:none;">
						<div class="home-container">
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
					<a href="/browse.php" style="text-decoration:none;">
						<div class="home-container">
							<h3>Browse Inventory</h3>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-6">
									<img src="img/browse.png" alt="browse image" style="width:100%;margin-top:10px">
								</div>
								<div class="col-sm-3"></div>
							</div>		
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="/account.php" style="text-decoration:none;">
						<div class="home-container">
							<h3>View Account</h3>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-6">
									<img src="img/account.png" alt="Account" style="width:100%;margin-top:10px">
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
						<a href="/messages.php" style="text-decoration:none;">
							<div class="home-container">
								<h3>View Message Center</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/message.png" alt="message" style="width:100%;margin-top:10px">
									</div>
									<div class="col-sm-3"></div>
								</div>		
							</div>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="/feedback.html" style="text-decoration:none;">
							<div class="home-container">
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
						<a href="/about.html" style="text-decoration:none;">
							<div class="home-container">
								<h3>About Us</h3>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<img src="img/info.png" alt="info" style="width:100%;margin-top:10px">
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
</div>
</body>
</html>

<!DOCTYPE html>

<html lang="en">
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  //When document has loaded
	$(document).ready(function(e){
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
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Better Bookstore</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="#">Help</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="messages.php"><span class="glyphicon glyphicon-envelope"></span>Messaging</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>My Account</a></li>
    </ul>
  </div>
</nav>
<div class="fluid-container">
	<div class="jumbotron text-center" style="background-color:#00cc7a">
	  <h1 style="color:white"><b>Better Bookstore</b></h1>
	  <p style="color:white">A money-saving marketplace for students</p>
	  <br>
	  <div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="input-group">
					<div class="input-group-btn search-panel">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span id="search_concept">Filter by</span> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
						  <li><a href="#Title">Title</a></li>
						  <li><a href="#Author">Author</a></li>
						  <li><a href="#ISBN">ISBN</a></li>
						  <li class="divider"></li>
						  <li><a href="#Prof">Professor</a></li>
						  <li><a href="#Course Name/Number">Course Name/Number</a></li>
						  <li><a href="#Major/Field">Major/Field</a></li>
						  <li><a href="#College">College</a></li>
						  <li class="divider"></li>
						  <li><a href="#all">Anything</a></li>
						</ul>
					</div>
					<input type="hidden" name="search_param" value="all" id="search_param">
					<input type="text" class="form-control" name="x" placeholder="Search term...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
					</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-7">
			<div class="fluid-container">
				<h3>We are implementing Better Bookstore, an application aimed at solving this issue. It aims to connect the buyer to the seller through an online service to minimize losses for both sides. Without getting too much into the economics of the situation, we are basically enabling buyers and sellers of textbooks to meet in the middle of the current buy and sell points through an exchange-type system. This will lower the price for textbook buyers, and raise the selling point of book sellers, meaning those who benefit most from transactions through our website are the users. On top of that, Better Bookstore allows users to buy and sell course documents, such as previous homework and midterm exams, allowing students to be best prepared for a class that they are taking. In general, our goal for the Better Bookstore is to ease the stress and financial burden of being a college student, allowing students to focus more on course content rather than the money or time it takes to get the proper course materials.</h3>
			</div>
		</div>
		<div class="col-sm-3">
			<img src="https://images-na.ssl-images-amazon.com/images/I/41cXTXhiabL._SX366_BO1,204,203,200_.jpg" width="90%" alt="no">
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</body>
</html>

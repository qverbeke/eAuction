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
	$(document).ready(function(e){
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
      <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>Log in or Register</a></li>
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
				<h3>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</h3>
			</div>
		</div>
		<div class="col-sm-3">
			<img src="http://knowledgequest.aasl.org/wp-content/uploads/2015/01/books.png" width="90%" alt="no">
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</body>
</html>

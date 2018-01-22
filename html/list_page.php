<!DOCTYPE html>
<html lang="en">
<head>
  <title>The cool website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/misc.css">
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
      <a class="navbar-brand" href="">Better Bookstore</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="#">Help</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
	  <li>    
		<form class="navbar-form navbar-left" action="/action_page.php">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	  </li>
      <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>Log in or Register</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-3">
			<div class="container-fluid" style="background-color:black; border-radius:20px">
				<?php
					for($i = 0; $i<50; $i++){
						echo "<p style=\"color:white\">This is the sidebar</p>";
					}
				?>
			</div>
		</div>
		<div class="col-sm-9" style="background-color:#00cc7a; padding-top:20px;padding-bottom:20px; border-radius:10px">
			<div class="container-fluid">
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
			<hr>
			<?php
			$descriptions=array("Here is all the useful book information stuff that you need to know",
								"Useful information about this book!! wow!",
								"Description about this book now. How cool!");
			$img_urls=array("https://images-na.ssl-images-amazon.com/images/I/41a28A84XhL._SX422_BO1,204,203,200_.jpg",
							"https://images-na.ssl-images-amazon.com/images/I/41cXTXhiabL._SX366_BO1,204,203,200_.jpg",
							"https://www.pearsonhighered.com/assets/bigcovers/0/2/0/5/0205583814.jpg");
			for($i=0;$i<3;$i++){	
				echo "<div class=\"container-fluid\" style=\"background-color:white; margin:10px 10px 20px 10px; border-radius:10px\">
					<div class=\"row\">
						<div class=\"col-sm-2\">
							<img src=\"".$img_urls[$i]."\" style=\"width:100%\">
						</div>
						<div class=\"col-sm-10\">
							<h1>".$descriptions[$i]."</h1>
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

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
  <script>
  var slider = document.getElementById("myRange");
	var output = document.getElementById("demo");
	output.innerHTML = slider.value; // Display the default slider value

	// Update the current slider value (each time you drag the slider handle)
	slider.oninput = function() {
		output.innerHTML = this.value;
	} 
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
      <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>Log in or Register</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-3">
			<div class="container-fluid" style="background-color:black; border-radius:20px">
				<div style="color:white">
					<br>
					<?php
						$hier=array("All Books", "---Penn State University", "------Eberly College of Science",
									"---------Math 040", "---------Math 140", "---------Math 141",
									"---------Math 230", "---------Math 250", "---------Math 251",
									"------College of Engineering", "---------AERO 020", "---------CMPSC 121");
						foreach($hier as $elem){
							echo "<a><p style=\"color:white\">$elem</p></a>";
						}					
					?>
					<br>
					<p>Price range:</p>
					<div class="checkbox active">
					  <label><input type="checkbox" checked="checked" value="">Any</label>
					</div>
					<div class="checkbox disabled">
					  <label><input type="checkbox" value="" disabled>$0-$50</label>
					</div>
					<div class="checkbox disabled">
					  <label><input type="checkbox" value="" disabled>$50-$100</label>
					</div>
					<div class="checkbox disabled">
					  <label><input type="checkbox" value="" disabled>$100-$150</label>
					</div> 
					<div class="checkbox disabled">
					  <label><input type="checkbox" value="" disabled>$150-$200</label>
					</div> 
					<p>Search Type</p>
					<div class="checkbox active">
					  <label><input type="checkbox" checked="checked" value="">Books</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Past Homeworks</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Past Exams</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Miscellaneous Documents</label>
					</div>
				</div>
				
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
			<hr>
			<?php
			$title="Calculus";//Note that these are all hard-coded for now. They will eventually come from our database
			$author="James Stewart";
			$edition="7th edition";
			$description = "Welcome to the wonderful world of calculus. This book is all about the details of calculus and I hope you learn a lot about calculus by reading this here book";
			$used_by=array("Math 140", "Math 141", "Math 230", "Math 250");
			$img_url = "https://images-na.ssl-images-amazon.com/images/I/41a28A84XhL._SX422_BO1,204,203,200_.jpg";
			$price="$100.00";
			$keywords=array("Math","Calc","Fun","Integrals");
			
			echo "<div class=\"container-fluid\" style=\"background-color:white; margin:10px 10px 10px 10px; border-radius: 10px\">
				<div class=\"row\">
					<div class=\"col-sm-4\" style=\"margin:10px\">
						<img src=\"".$img_url."\" style=\"width:100%\">
					</div>
					<div class=\"col-sm-8\" style=\"margin-right:-30px\">
						<div class=\"row\">
							<div class=\"col-sm-7\">
								<h1 style=\"line-height:0.6\">".$title."</h1>
								<h3>".$author."</h3>
								<h4>".$edition."</h4>
								<h3>".$description."</h3>
								<h5>Keywords: ";
								foreach($keywords as $keyword){
									echo "<a>$keyword</a>, ";
								}
						  echo "</h5>
							</div>
							<div class=\"col-sm-5\" style=\"padding-right:20px\">
								<h3 style=\"line-height:0.6\">Available from:</h3>
								<h2><b>".$price."</b></h2>
								<hr>
								<h4>Used in:</h4>";
								foreach($used_by as $user){
									echo "<h3>$user</h3>";
								}
					 echo "</div>
						</div>
					</div>
				</div>				
			</div>";
		?>
		</div>
	</div>
</div>

</body>

</html>

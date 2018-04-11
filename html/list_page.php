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
							  <li><a href="#Course Name/Number">Course Name/Number</a></li>
							  <li><a href="#Major/Field">Major/Field</a></li>
							  <li><a href="#College">College</a></li>
							  <li class="divider"></li>
							  <li><a href="#all">Anything</a></li>
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
			//$myfile=fopen("../../../home/ubuntu/pass.txt", "r")
			$mysqli = mysqli_connect("localhost", "root", "zPp>v\/16S,DO*", "betterbookstore");//fread($myfile,filesize("pass.txt")), "better_bookstore");
			//fclose($myfile);
			
			$ISBN="9781285741550";
			$query="SELECT * FROM Book B, Book_NAE N, Book_Name_Desc_Key D WHERE B.ISBN='".$ISBN."' AND B.ISBN=N.ISBN AND B.Name=D.Name AND B.Description=D.Description";
			$result=mysqli_query($mysqli, $query);
			while($book_info = mysqli_fetch_assoc($result)){
				echo "<div class=\"container-fluid\" style=\"margin:20px 0px 10px 0px\">
					<div class=\"row\">
						<div class=\"col-sm-2\" style=\"background-color:white; border-radius:10px; margin-right:10px; padding-top:10px; padding-bottom:10px\">
							<div class=\"textbook-img\">
								<img src=\"".$book_info["ImgURL"]."\" style=\"width:100%\">
							</div>
						</div>
						<div class=\"col-sm-10 textbook-info-container\" style=\"background-color:white; border-radius:10px; margin-right:-30px\">
							<div class=\"row\">
								<div class=\"col-sm-8\">
									<h1>".$book_info["Name"]."</h1>
									<h3>".$book_info["Description"]."</h3>
								</div>
								<div class=\"col-sm-4\">
									<h3>".$book_info["Author"]."</h3>
									<h4>Edition: ".$book_info["Edition"]."</h4>
								</div>
							</div>
							<h5>Keywords: ";
							$keywords = explode(",", $book_info["MyKeys"]);
							foreach($keywords as $keyword){
								echo "<a>$keyword</a>, ";
							}
							
							echo "</h5>
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


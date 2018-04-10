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
					<form>
						<div class="checkbox active">
						  <label><input type="checkbox" checked="checked" value="" onchange="var thing = document.getElementsByClassName('pricerange'); for(i=0; i<thing.length; i++){thing[i].disabled = this.checked; thing[i].checked=0;}">Any</label>
						</div>
						<div class="checkbox disabled">
						  <label><input class="pricerange" type="checkbox" value="" disabled>$0-$50</label>
						</div>
						<div class="checkbox disabled">
						  <label><input class="pricerange" type="checkbox" value="" disabled>$50-$100</label>
						</div>
						<div class="checkbox disabled">
						  <label><input class="pricerange" type="checkbox" value="" disabled>$100-$150</label>
						</div>
						<div class="checkbox disabled">
						  <label><input class="pricerange" type="checkbox" value="" disabled>$150-$200</label>
						</div>

					<p>Search Type</p>
					<div class="checkbox active">
					  <label><input type="checkbox" checked="checked" value="">Books</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" checked="checked" value="">Past Homeworks</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" checked="checked" value="">Past Exams</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" checked="checked" value="">Miscellaneous Documents</label>
					</div>
					<input type="submit" value="Update Preferences">
					</form>
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
			$myfile=fopen("../../../../home/ubuntu/pass.txt", "r")
			$mysqli = mysqli_connect("localhost", "root", fread($myfile,filesize("pass.txt")), "better_bookstore");
			fclose($myfile);
			$query="SELECT * FROM Book B, Book_NAE N, Book_Name_Desc D WHERE B.ISBN='9781285741550' AND B.ISBN=N.ISBN AND B.Name=D.Name AND B.Description=D.Description";
			$result=mysqli_query($mysqli, $query);
			$book_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$title=$book_info["Name"];//Note that these are all hard-coded for now. They will eventually come from our database
			$author="James Stewart";
			$edition="7th edition";
			$description = "Welcome to the wonderful world of calculus. This book is all about the details of calculus and I hope you learn a lot about calculus by reading this here book";
			$used_by=array("Math 140", "Math 141", "Math 230", "Math 250");
			$img_url = "https://images-na.ssl-images-amazon.com/images/I/41a28A84XhL._SX422_BO1,204,203,200_.jpg";
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
								<h2>Used in:</h2><hr>";
								foreach($used_by as $user){
									echo "<h3>$user</h3>";
								}
					 echo "</div>
						</div>
					</div>
				</div>
			</div>";
			$list_price=array("30.50", "100.99", "300.34");
			$list_qual=array("Bad", "Good", "New");
			$seller_rating=array("5", "3.3", "2.9");
			for($i=0; $i<count($list_price); $i=$i+1){
				echo "<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px; height: 60px'>
					<div class='row'>
						<div class='col-sm-1'>
							<button class='btn btn-primary' style='margin-top:6px; font-size:24px;' value='Buy'>BUY</button>
						</div>
						<div class='col-sm-3' style='margin-top:-2px'>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-sm-6'>
										<h3 align='right'>Price:</h3>
									</div>
									<div class='col-sm-6'>
										<h3 align='left'><b>$".$list_price[$i]."</b></h3>
									</div>
								</div>
							</div>
						</div>
						<div class='col-sm-3' style='margin-top:-2px'>
							<div class='container-fluid'
							>
								<div class='row'>
									<div class='col-sm-6'>
										<h3 align='right'>Quality:</h3>
									</div>
									<div class='col-sm-6'>
										<h3 align='left'><b>".$list_qual[$i]."</b></h3>
									</div>
								</div>
							</div>
						</div>
						<div class='col-sm-5'>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-sm-3' style='margin-top:2px'><h4>Seller Rating:</h4></div>
									<div class='col-sm-5'>";
										for ($j=0; $j<floor(floatval($seller_rating[$i])); $j=$j+1){
											echo "<img src='img/star.png' style='white-space: nowrap; width:20px; padding-top:23px'>";
										}
									echo "</div>
									<div class='col-sm-4'>
										<h4 style='padding-top:14px'>".$seller_rating[$i]."/5 stars</h4>
									</div>
								</div>
							</div>
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

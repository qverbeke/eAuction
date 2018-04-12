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
								<h5>".$book_info["Description"]."</h3>
								<h3>Keywords: ";
								$keywords = explode(",", $book_info["MyKeys"]);
								foreach($keywords as $keyword){
									echo "<a>$keyword</a>, ";
								}
						  echo "</h5>
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
			
			$query="SELECT L.Price, BL.Quality, S.Seller_rating FROM Book B, Book_Listing BL, Listing L, Seller S WHERE B.ISBN='".$ISBN."' AND B.ISBN=BL.ISBN AND BL.LID=L.LID AND L.Seller_UID=S.UID;";
			$result=mysqli_query($conn, $query);
			while($listing_info = mysqli_fetch_assoc($result)){
				echo "<div class='container-fluid' style='background-color:white; margin:10px 10px 10px 10px; border-radius: 10px'>
					<div class='row'>
						<div class='col-sm-2'>
							<button class='btn btn-primary' style='margin-top:6px; width:100%; font-size:24px; margin-top:13px' value='Buy'>BUY</button>
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
							<div class='container-fluid'
							>
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
		?>
		</div>
	</div>
</div>

</body>

</html>

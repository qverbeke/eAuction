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
<div id="navbar" style="margin-top:50px;">
</div>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10" >
			<div class="container-fluid">
				<form action="list_page.php">
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
			$search_param=$_GET['search_param'];
			$query="";
			if($search_param=="ISBN"||$search_param=="Title"||$search_param=="Author"){
				if($search_param=="ISBN"){
					$query_piece="B.ISBN='".$_GET['search_term']."'";
				}
				elseif($search_param=="Title"){
					$query_piece="B.Name='".$_GET['search_term']."'";
				}
				elseif($search_param=="Author"){
					$query_piece="N.Author='".$_GET['search_term']."'";
				}
				$query="SELECT * FROM Book B, Book_NAE N, Book_Name_Desc_Key D WHERE ".$query_piece." AND B.ISBN=N.ISBN AND B.Name=D.Name AND B.Description=D.Description";
			}
			else{
				exit(1);
			}
			$result=mysqli_query($conn, $query);
			while($book_info = mysqli_fetch_assoc($result)){
				echo "<a href=\"book_page.php?ISBN=".$book_info["ISBN"]."\"><div class=\"container-fluid\" style=\"margin:20px 0px 10px 0px\">
					<div class=\"row\">
						<div class=\"col-sm-2\" style=\"background-color:white; border-radius:10px; margin-right:10px; padding-top:10px; padding-bottom:10px\">
							<div class=\"textbook-img\">
								<img src=\"".$book_info["ImgURL"]."\" style=\"height:150px\">
							</div>
						</div>
						<div class=\"col-sm-10\" style=\"background-color:white; border-radius:10px; margin-right:-30px\">
							<div class=\"row\">
								<div class=\"col-sm-8\">
									<h2>".$book_info["Name"]."</h2>
									<h3>".substr($book_info["Description"], 0, 100)."...</h3>
								</div>
								<div class=\"col-sm-4\">
									<h3>".$book_info["Author"]."</h3>
									<h4>Edition: ".$book_info["Edition"]."</h4>
									<h4>ISBN: ".$book_info["ISBN"]."</h4>
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
				</div></a>";
			}
			?>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>

</body>

</html>

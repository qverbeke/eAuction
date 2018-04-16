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
<body>
<div id="navbar" style="margin-top:50px;">
</div>
	<div class="container-fluid with-navbar">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-3">
				<div class="container-fluid" style="background-color:black; border-radius:20px">
					<?php
					include_once 'connect-to-database.php';
					$query = "SELECT B.ISBN, B.Name, B.Description, B.ImgURL, N.Author, N.Edition FROM Book_Listing BL, Book B, Book_NAE N WHERE BL.LID='".$_POST['LID']."' AND BL.ISBN = B.ISBN AND B.ISBN=N.ISBN;";
					$result=mysqli_query($conn, $query);
					$book_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo "<h3 style='color:white'>".$book_info["Name"]."</h3>
					<h4 style='color:white'>".$book_info["Author"]."</h4>
					<img src='".$book_info["ImgURL"]."' alt='Book Image' style='width:100%'>
					<h4 style='color:white'>Edition: ".$book_info["Edition"]."</h4>
					<p style='color:white'>".$book_info["Description"]."</p>";
					?>
				</div>
			</div>
			<div class="col-sm-7" style="background-color:#00cc7a; border-radius:20px">
				<h2 style="color:white">Purchase Information:</h2>
				<?php
					include_once 'connect-to-database.php';
					$query="SELECT * FROM Seller S, ";
				?>
			</div>
			<div class="col-sm-1"></div>
		</div>
	</div>
</body>

</html>

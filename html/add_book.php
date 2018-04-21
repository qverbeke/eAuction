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
<body style="background-color:#00cc7a;">
<div id="navbar" style="margin-top:50px;"></div>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8" style="background-color:white;padding-top:20px;padding-bottom:20px; border-radius:10px">
			<h1>Enter some basic information about the book you will be selling.</h1>
			<form action="action_create_book.php" id="bookform" method="POST">
				<div class="form-group">
					<label for="ISBN">ISBN-13 (only digits)</label>
					<input type="text" pattern="[0-9]{13}" class="form-control" id="ISBN" placeholder="Enter the 13 digit ISBN" name="ISBN" maxlength="13">
				</div>
				<div class="form-group">
					<label for="name">Title</label>
					<input type="text" pattern=".+" class="form-control" id="name" placeholder="Enter the full title of the book" name="Title">
				</div>
				<div class="form-group">
					<label for="Edition">Edition</label>
					<input type="number" class="form-control" min="1" step="1" id="Edition" placeholder="Enter the edition of the book" name="Edition">
				</div>
				<div class="form-group">
					<label for="Author">Author</label>
					<input type="text" pattern=".+" class="form-control" id="Author" placeholder="Enter the author of the book" name="Author">
				</div>
				<div class="form-group">
					<label for="Keywords">Keywords</label>
					<input type="text" class="form-control" id="Keywords" placeholder="Enter any number of keywords, separated by commas." name="Keywords">
				</div>
				<div class="form-group">
					<label for="ImgURL">Image URL</label>
					<input type="text" class="form-control" id="ImgURL" placeholder="(Optional) Enter the URL for an image of the book cover" name="ImgURL">
				</div>
				<div class="form-group">
					<label for="desc">Description</label><br>
					<textarea name="Description" id="desc" form="bookform" rows="10" cols="100" placeholder="Enter a short (&lt;2000) character description of the book."></textarea>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6"><input class="btn btn-primary"type="submit" value="Add Book" style="width:100%; font-size:24px"></div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
</body>
</html>

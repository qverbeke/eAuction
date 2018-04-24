<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=feedback");
}
?>

<html lang="en">
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/misc.css">
  <link rel="stylesheet" href="styles/wishlist.css">
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
  <script>
  function book(ISBN){
	window.location = 'book_page.php?ISBN='+ISBN; 
  }
  </script>
</head>
<body style="background-color:#00cc7a">
<div id="navbar" style="margin-top:50px;"></div>
<div class="container-fluid with-navbar">

<div>
	<br>
  <div id="navbar" style="margin-top:5px;">
  </div>
  <div class="row">
	  <div class="col-sm-3"></div>
	  <div class="col-sm-6" style="background-color:white; border-radius: 10px">
	<h3>Provide site feedback</h3>
  <form action = "action_create_feedback.php" method = "post">
        Title:
        <input type = "text" name = "Title" maxlength = "500">
        <input type="checkbox" name="check" value="1"> Is there a Bug? <br>


        <textarea name="Content" rows="10" placeholder="Please share your comments with us..." style="width:100%"></textarea>
         <br>
		 <div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<button type = "submit" name = "submit" class="btn btn-primary" style="width:100%; font-size:20px"> Submit</button>
			</div>
			<div class="col-sm-3"></div>
		 </div>
         
      </form>
      </div>
      <div class="col-sm-3"></div>
   </div>


</body>
</html>

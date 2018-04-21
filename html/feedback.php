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

<div style="background-color:white; border-radius: 10px">
	<br>

<html lang="en">

<body>
  <div id="navbar" style="margin-top:5px;">
  </div>

  <form action = "feedback.php" method = "post">
        Title:
        <input type = "text" name = "Title" maxlength = "500"  />
         <br />

         <br />
         <br />
         <br />

        <input type="checkbox" name="check" value="Yes"> Is there a Bug? <br>


        <textarea name="Content" rows=10 cols=35> Please share your comments with us
     
        </textarea>
         <br>

         <button type = "submit" name = "submit"> Submit</button>
      </form>


</body>



<?php
  include_once 'connect-to-database.php';
    $title = $_POST['Title'];
    $check = $_POST['check'];
    $content = $_POST['Content'];

    $sql = "INSERT INTO Feedback (Is_bug, Title, Content) VALUES ('$title',  '$check', '$content');";
    mysqli_query($conn, $sql);
    header("Location: feedback.php");


















  
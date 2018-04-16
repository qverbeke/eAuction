<!DOCTYPE html>

<html lang="en">
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  //When document has loaded
	$(document).ready(function(e){
    $('#navbar').load("navbar.html");
    $('#course-document-form').hide();
    $('#book-button').click(function(){
      $('#course-document-form').hide();
      $('#book-form').show();
      $(this).addClass("btn-primary");
      $(this).removeClass("btn-secondary");
      $('#course-document-button').removeClass("btn-primary");
      $('#course-document-button').addClass("btn-secondary");

    });
    $('#course-document-button').click(function(){
      $('#course-document-form').show();
      $('#book-form').hide();
      $(this).addClass("btn-primary");
      $(this).removeClass("btn-secondary");
      $('#book-button').removeClass("btn-primary");
      $('#book-button').addClass("btn-secondary");
    });
	});
	</script>
</head>
<body>
<div id="navbar" style="margin-top:50px;">
</div>
<div class="container">
    <h1>Create a Listing </h1>
    <br>
    <p>Create a listing for a: </p>
    <div style="padding-bottom:20px;">
       <button id="book-button" class="btn btn-primary">
        Book
      </button>
      <button id="course-document-button" class="btn btn-secondary">
        Course Document
      </button>
    </div>
    <form id="book-form">
      <div class="form-group">
        <label for="select-book">Select Book to Sell</label>
          <select class="form-control" id="select-book">
            <?php
              include_once 'connect-to-database.php';
              $sql_statement = 'Select B.Name FROM Book B';
              $result = mysqli_query($conn, $sql_statement);
              if (!$result) {
                echo 'Could not run query: ' . mysqli_error();
                exit();
              }
              for($i = 0; $i < mysqli_num_rows($result); $i++){
                $book_name = mysqli_fetch_row($result)[0];
                echo "<option> {$book_name} </option>";
              }

            ?>
          </select>
      </div>
      <div class="form-group">
        <label for="book-price">Price</label>
        <input type="number" min="0.01" step="any" class="form-control" id="book-price" placeholder="Enter price in dollars">
      </div>
      <div class="form-group">
        <label for="select-quality">Select Quality</label>
          <select class="form-control" id="select-quality">
            <option>New</option>
            <option>Like New</option>
            <option>Great</option>
            <option>Good</option>
            <option>Fair</option>
            <option>Bad</option>
            <option>Very Bad</option>
          </select>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>

    </form>
    <form id="course-document-form">
      <div class="form-group">
        <label for="title">Document Title</label>
        <input type="text" class="form-control" id="title" placeholder="Title of the Document">
      </div>
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" min="0.01" step="any" class="form-control" id="book-price" placeholder="Enter price in dollars">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea rows="5" type="text" class="form-control" id="description"></textarea>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>

</div>

</body>

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
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <script>
	$(document).ready(function(e){
    $('#navbar').load("navbar.html");
	});
  </script>
  <style media="screen" type="text/css">

      div.stars {
      width: 270px;
      display: inline-block;
    }
    input.star { display: none; }

    label.star {
      float: right;
      padding: 3px;
      font-size: 36px;
      color: #444;
      transition: all .2s;
    }

    label.star:hover { cursor: pointer;}

    label.star:before {
      content: '\f006';
      font-family: FontAwesome;
    }

  </style>
  <script>
  $(document).ready(function(e){
    $('.star').click(function(){
      var prev = $(this).prevAll();
      var next = $(this).nextAll();
      prev.css("color", "#444");
      next.css("color", "#FD4");
      });
	});
  </script>

</head>
<body>
  <div id='navbar'>
  </div>
  <div class="container" style="margin-top:53px;">
    <div class="stars">
      <form action="">
        <input class="star star-5" id="star-5" type="radio" name="star"/>
        <label class="star star-5 " for="star-5"></label>
        <input class="star star-4 " id="star-4" type="radio" name="star"/>
        <label class="star star-4" for="star-4"></label>
        <input class="star star-3" id="star-3" type="radio" name="star"/>
        <label class="star star-3" for="star-3"></label>
        <input class="star star-2" id="star-2" type="radio" name="star"/>
        <label class="star star-2" for="star-2"></label>
        <input class="star star-1" id="star-1" type="radio" name="star"/>
        <label class="star star-1" for="star-1"></label>
      </form>
  </div>
  <div class="stars">
    <br><br>
    <form action="">
      <input class="star star-5" id="1star-5" type="radio" name="star"/>
      <label class="star star-5" for="1star-5"></label>
      <input class="star star-4" id="2star-4" type="radio" name="star"/>
      <label class="star star-4" for="2star-4"></label>
      <input class="star star-3" id="3star-3" type="radio" name="star"/>
      <label class="star star-3" for="3star-3"></label>
      <input class="star star-2" id="4star-2" type="radio" name="star"/>
      <label class="star star-2" for="4star-2"></label>
      <input class="star star-1" id="5star-1" type="radio" name="star"/>
      <label class="star star-1" for="5star-1"></label>
    </form>
  </div>
    <h1 style="margin-bottom:25px"> Purchase History </h1>
    <div class="list-group">
  <?php
    include_once 'connect-to-database.php';
    $uid = $_SESSION["UID"];
    $sql_statement = "Select T.Online_or_live, T.Timestamp, T.LID FROM Transaction T
     WHERE T.Buyer_UID={$uid} ORDER BY T.Timestamp";
    $result = mysqli_query($conn, $sql_statement);
    if(!$result){
      echo 'Could not run query: ' . mysqli_error($conn);
      exit();
    }
    $num_results = mysqli_num_rows($result);
    $og_result = $result;
    for ($i = 0; $i < $num_results; $i++){
      $row = mysqli_fetch_row($og_result);
      $lid = $row[2];
      $timestamp = $row[1];
      $online_or_live = $row[0];
      $sql_statement = "SELECT L.Price, L.Seller_UID FROM Listing L WHERE L.LID={$lid}";
      $result = mysqli_query($conn, $sql_statement);
      if(!$result){
        echo 'Could not run query: ' . mysqli_error($conn);
        exit();
      }
      $row = mysqli_fetch_row($result);
      $price = $row[0];
      $seller_uid = $row[1];
      $sql_statement = "SELECT UU.username FROM User_Username UU WHERE UU.UID={$seller_uid}";
      $result = mysqli_query($conn, $sql_statement);
      if(!$result){
        echo 'Could not run query: ' . mysqli_error($conn);
        exit();
      }
      $seller_username = mysqli_fetch_row($result)[0];
      $sql_statement = "SELECT CDL.Type, CDL.Title FROM Course_Doc_Listing CDL WHERE CDL.LID={$lid}";
      $result = mysqli_query($conn, $sql_statement);
      if(!$result){
        echo 'Could not run query: ' . mysqli_error($conn);
        exit();
      }

      echo "<a href=\"#\" class=\"list-group-item list-group-item-action align-items-start\">";
      //If this is a course document
      if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_row($result);
        $type = $row[0];
        $title = $row[1];
        echo "
        Time Purchased: {$timestamp} <br>
        Item Type: Course Document <br>
        Document Title: {$title} <br>
        Price: {$price} <br>
        Bought From: {$seller_username}";

      }else{
        $sql_statement = "SELECT BL.Quality, BL.ISBN FROM Book_Listing BL
         WHERE BL.LID={$lid}";
         $result = mysqli_query($conn, $sql_statement);
         if(!$result){
           echo 'Could not run query: ' . mysqli_error($conn);
           exit();
         }
         $row = mysqli_fetch_row($result);
         $quality = $row[0];
         $isbn = $row[1];
         $sql_statement = "SELECT B.Name FROM Book B WHERE B.ISBN=\"{$isbn}\" ";
         $result = mysqli_query($conn, $sql_statement);
         if(!$result){
           echo 'Could not run query: ' . mysqli_error($conn);
           exit();
         }
         $row = mysqli_fetch_row($result);
         $title = $row[0];
         echo "
         Time Purchased: {$timestamp} <br>
         Item Type: Book <br>
         Book Title: {$title} <br>
         Price: {$price} <br>
         Quality: {$quality} <br>
         Bought From: {$seller_username}
         ";

      }
      echo "</a>";
    }
    ?>
  </div>
 </div>
</body>

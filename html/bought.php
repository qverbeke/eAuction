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
	});
  </script>
</head>
<body>
  <div id='navbar'>
  </div>
  <div class="container" style="margin-top:53px;">
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
    for ($i = 0; $i < mysqli_num_rows($result); $i++){
      $row = mysqli_fetch_row($result);
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

<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=wishlist");
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
  <h1>Your Wishlist</h1>
  <table class="data-table">
    <caption class="title">Click on a row in the table to be taken to that book.</caption>
    <thead>
      <tr>
        <th>Num</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Price</th>
      </tr>
    </thead>                                                                                                           
    <tbody>         
  <?php
    $no   = 1;
    $total  = 0;
	include_once 'connect-to-database.php';
    $sql = "SELECT B.ISBN, BW.Timestamp, N.Author, BW.Desired_price, B.Name FROM Buyer_Wants_Book BW, Book B, Book_NAE N WHERE BW.UID = ".$_SESSION["UID"]." AND B.ISBN=BW.ISBN AND B.ISBN=N.ISBN;";
    $result = mysqli_query($conn,$sql);
    //$resultcheck = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result))
    {
      $amount  = $row['Desired_price'] == 0 ? '' : $row['Desired_price'];
      $time = strtotime($row["Timestamp"]);
	  $myFormatForView = date("m/d/y", $time);
      echo '<tr onclick="book('.$row["ISBN"].')">
          <td>'.$no.'</td>
          <td>'.$row['Name'].'</td>
          <td>'.$row['Author'].'</td>
          <td>'.$myFormatForView.'</td>
          <td>$'.$amount.'</td>
        </tr>';
      $total += $amount;
      $no++;
      
    }
    echo '
    </tbody>
    
    <tfoot>
      <tr>
        <th colspan="4">TOTAL</th>
        <th>$'.$total;
        ?></th>
      </tr>
    </tfoot>
  </table>
  <br>
  <br>
  </div>
  </div>
</body>
</html>


    
    

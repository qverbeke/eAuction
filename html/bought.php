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
  <?php
    include_once 'connect-to-database.php';
    $uid = $_SESSION["UID"];
    $sql_statement = "Select T.Online_or_live, T.Timestamp, T.LID FROM Transaction T WHERE T.Buyer_UID={$uid}";
    $result = mysqli_query($conn, $sql_statement);
    if(!$result){
      echo 'Could not run query: ' . mysqli_error($conn);
      exit();
    }
    for ($i = 0; $i < mysqli_num_rows($result); $i++){
      $row = mysqli_fetch_row($result);
      echo($row[2]);
    }
   ?>
 </div>
</body>

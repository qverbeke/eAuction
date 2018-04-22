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
      width: 150px;
      display: inline-block;
    }
    input.star { display: none; }

    label.star {
      float: right;
      padding: 3px;
      font-size: 24px;
      color: #444;
    }

    label.star:hover { cursor: pointer;}

    label.star:before {
      content: '\f006';
      font-family: FontAwesome;
    }

  </style>
  <script>
  $(document).ready(function(e){
    $('input.star').click(function(){
      if($(this).parent().attr("class")=="noclick"){
        return;
      }
      var prev = $(this).prevAll();
      var next = $(this).nextAll();
      prev.css("color", "#444");
      next.css("color", "#FD4");
      $(this).css("color", "#FD4");
      $(this).unbind();
      prev.unbind();
      next.unbind();
      var a_text = $(this).parent().parent().parent().text();
      var index1 = a_text.indexOf('User:');
      var index2 = a_text.indexOf('Rate');
      var username = a_text.substring(index1 + 6, index2);
      var rated1 = "Seller";
      if (a_text.indexOf("Bought") >= 0){
        rated1 = "Seller";
      }else{
        rated1 = "Buyer";
      }

      var rating = Math.floor(next.length / 2) + 1;
      $.ajax({
        type:"POST",
        url: "action_rate.php",
        data: {username1: username, rating1:rating, rated:rated1},
        success: function(result){
          alert(result);
        }
      });
    });
	});
  </script>
  <script>
  //When document has loaded
	$(document).ready(function(e){
    $('#selling-history').hide();
    $('#selling-button').click(function(){
      $('#purchase-history').hide();
      $('#selling-history').show();
      $(this).addClass("btn-primary");
      $(this).removeClass("btn-secondary");
      $('#purchase-button').removeClass("btn-primary");
      $('#purchase-button').addClass("btn-secondary");

    });
    $('#purchase-button').click(function(){
      $('#purchase-history').show();
      $('#selling-history').hide();
      $(this).addClass("btn-primary");
      $(this).removeClass("btn-secondary");
      $('#selling-button').removeClass("btn-primary");
      $('#selling-button').addClass("btn-secondary");
    });
	});
	</script>

</head>
<body>
  <div id='navbar'>
  </div>
  <div class="container" style="margin-top:53px;">

    <h1 style="margin-bottom:25px"> Transaction History </h1>
    <div style="margin-bottom:10px;">
      <button id="purchase-button" class="btn btn-primary">
       Purchase History
     </button>
     <button id="selling-button" class="btn btn-secondary">
       Selling History
     </button>
   </div>
    <div id="purchase-history" class="list-group">
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
        Bought From User: {$seller_username}
        <br>";

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
         Bought From User: {$seller_username}
         <br>";

      }
      $sql_statement = "SELECT URU.Rating FROM User_Rates_User URU
      WHERE URU.Seller_UID={$seller_uid} AND URU.Buyer_UID={$uid} AND
      URU.Rated=\"Seller\"";
      $result = mysqli_query($conn, $sql_statement);
      if(!$result){
        echo $sql_statement;
        echo 'Could not run query: ' . mysqli_error($conn);
        exit();
      }
      echo 'Rate this user: <br>
      <div class="stars">
        <form action="">';
      if(mysqli_num_rows($result) == 0){
        echo'
            <input class="star star-5" id="'.$i.'star-5" type="radio" name="star"/>
            <label class="star star-5 " for="'.$i.'star-5"></label>
            <input class="star star-4" id="'.$i.'star-4" type="radio" name="star"/>
            <label class="star star-4" for="'.$i.'star-4"></label>
            <input class="star star-3" id="'.$i.'star-3" type="radio" name="star"/>
            <label class="star star-3" for="'.$i.'star-3"></label>
            <input class="star star-2" id="'.$i.'star-2" type="radio" name="star"/>
            <label class="star star-2" for="'.$i.'star-2"></label>
            <input class="star star-1" id="'.$i.'star-1" type="radio" name="star"/>
            <label class="star star-1" for="'.$i.'star-1"></label>
          ';
    }else{
      $rating = mysqli_fetch_row($result)[0];
      echo '<div class="noclick">';
      for($k = 5; $k >= 1; $k = $k - 1){
        echo
        '<input class="star star-'.$k.'" id="'.$i.'star-'.$k.'" type="radio" name="star"';
        if ($k > $rating){
          echo 'style="color:#444;" ';
        }
        else{
          echo 'style="color:#FD4;" ';
        }
        echo '/>
        <label class="star star-'.$k.' " for="'.$i.'star-'.$k.'" ';
        if ($k > $rating){
          echo 'style="color:#444;" ';
        }
        else{
          echo 'style="color:#FD4;" ';
        }
        echo '
        ></label> ';
      }
      echo '</div>';
    }

    echo '</form>
</div>
';
    echo "</a>";
    }
    ?>
  </div>
  <div id="selling-history" class="list-group">
    <?php
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      include_once 'connect-to-database.php';
      $uid = $_SESSION["UID"];
      $sql_statement = "SELECT UU.username, L.Price, T.Timestamp, L.LID FROM Transaction T,
      Listing L, User_Username UU WHERE UU.UID=T.Buyer_UID AND
      T.LID=L.LID AND L.Seller_UID={$uid} ORDER BY T.Timestamp";
      $result = mysqli_query($conn, $sql_statement);
      if(!$result){
        echo $sql_statement;
        echo 'Could not run query: ' . mysqli_error($conn);
        exit();
      }
      $num_results = mysqli_num_rows($result);
      $og_result = $result;
      for ($i = 0; $i < $num_results; $i++){
        $row = mysqli_fetch_row($og_result);
        $buyer_username = $row[0];
        $price = $row[1];
        $timestamp = $row[2];
        $lid = $row[3];
        $sql_statement = "SELECT CDL.Type, CDL.Title FROM Course_Doc_Listing CDL WHERE CDL.LID={$lid}";
        $result = mysqli_query($conn, $sql_statement);
        if(!$result){
          echo 'Could not run query: ' . mysqli_error($conn);
          exit();
        }

        echo "<a href=\"#\" class=\"list-group-item list-group-item-action align-items-start\">";
        if(mysqli_num_rows($result) == 1){
          $row = mysqli_fetch_row($result);
          $type = $row[0];
          $title = $row[1];
          echo "
          Time Sold: {$timestamp} <br>
          Item Type: Course Document <br>
          Document Title: {$title} <br>
          Price: {$price} <br>
          Sold to User: {$buyer_username}
          <br>";
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
           Time Sold: {$timestamp} <br>
           Item Type: Book <br>
           Book Title: {$title} <br>
           Price: {$price} <br>
           Quality: {$quality} <br>
           Sold to User: {$buyer_username}
           <br>";
        }
        echo 'Rate this user: <br>
        <div class="stars">
          <form action="">
            <input class="star star-5" id="x'.$i.'star-5" type="radio" name="star"/>
            <label class="star star-5 " for="x'.$i.'star-5"></label>
            <input class="star star-4" id="x'.$i.'star-4" type="radio" name="star"/>
            <label class="star star-4" for="x'.$i.'star-4"></label>
            <input class="star star-3" id="x'.$i.'star-3" type="radio" name="star"/>
            <label class="star star-3" for="x'.$i.'star-3"></label>
            <input class="star star-2" id="x'.$i.'star-2" type="radio" name="star"/>
            <label class="star star-2" for="x'.$i.'star-2"></label>
            <input class="star star-1" id="x'.$i.'star-1" type="radio" name="star"/>
            <label class="star star-1" for="x'.$i.'star-1"></label>
          </form>
      </div>
      ';
      echo "</a>";
      }


    ?>
  </div>
 </div>
</body>

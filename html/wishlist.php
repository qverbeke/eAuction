<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=wishlist");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" style="display:block;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Better Bookstore</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="browse.php">Browse</a></li>
      <li><a href="browse.php">WishList</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="messages.php"><span class="glyphicon glyphicon-envelope"></span>Messaging</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-user"></span>My Account</a></li>
    </ul>
  </div>
</nav>
</body>
</html>

<html lang="en">
<head>
  <title>The Wishlist</title>
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
  <style type="text/css">
  

    body {
      font-size: 15px;
      color: #343d44;
      font-family: "segoe-ui", "open-sans", tahoma, arial;
      padding: 0;
      margin: 0;
    }
    table {
      margin: auto;
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      font-size: 12px;
    }

    h1 {
      margin: 25px auto 0;
      text-align: center;
      text-transform: uppercase;
      font-size: 17px;
    }

    table td {
      transition: all .5s;
    }
    
    /* Table */

    .data-table {
    	align="center"
      border-collapse: collapse;
      font-size: 14px;
      min-width: 600px;
    }

    .data-table th, 
    .data-table td {
      border: 1px solid #e1edff;
      padding: 7px 17px;
    }
    .data-table caption {
      margin: 7px;
    }

    /* Table Header */
    .data-table thead th {
      background-color: #508abb;
      color: #FFFFFF;
      border-color: #6ea1cc !important;
      text-transform: uppercase;
    }

    /* Table Body */
    .data-table tbody td {
      color: #353535;
    }
    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),
    .data-table tbody td:last-child {
      text-align: right;
    }

    .data-table tbody tr:nth-child(odd) td {
      background-color: #f4fbff;
    }
    .data-table tbody tr:hover td {
      background-color: #ffffa2;
      border-color: #ffff0f;
    }

    /* Table Footer */
    .data-table tfoot th {
      background-color: #e5f5ff;
      text-align: right;
    }
    .data-table tfoot th:first-child {
      text-align: left;
    }
    .data-table tbody td:empty
    {
      background-color: #ffcccc;
    }
  </style>
</head>
<body>
<div id="navbar" style="margin-top:50px;">
</div>
<title>The Wishlist</title>
<div class="container-fluid with-navbar">
  <div class="row">
    <div class="col-sm-3">
      <div class="container-fluid" style="background-color:black; border-radius:20px">
        <div style="color:white">
          <br>
          <?php
            $hier=array("All Books", "---Penn State University", "------Eberly College of Science",
                  "---------Math 040", "---------Math 140", "---------Math 141",
                  "---------Math 230", "---------Math 250", "---------Math 251",
                  "------College of Engineering", "---------AERO 020", "---------CMPSC 121");
            foreach($hier as $elem){
              echo "<a><p style=\"color:white\">$elem</p></a>";
            }
          ?>
          <br>
          <p>Price range:</p>
          <form>
            <div class="checkbox active">
              <label><input type="checkbox" checked="checked" value="" onchange="var thing = document.getElementsByClassName('pricerange'); for(i=0; i<thing.length; i++){thing[i].disabled = this.checked; thing[i].checked=0;}">Any</label>
            </div>
            <div class="checkbox disabled">
              <label><input class="pricerange" type="checkbox" value="" disabled>$0-$50</label>
            </div>
            <div class="checkbox disabled">
              <label><input class="pricerange" type="checkbox" value="" disabled>$50-$100</label>
            </div>
            <div class="checkbox disabled">
              <label><input class="pricerange" type="checkbox" value="" disabled>$100-$150</label>
            </div>
            <div class="checkbox disabled">
              <label><input class="pricerange" type="checkbox" value="" disabled>$150-$200</label>
            </div>

          <p>Search Type</p>
          <div class="checkbox active">
            <label><input type="checkbox" checked="checked" value="">Books</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" checked="checked" value="">Past Homeworks</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" checked="checked" value="">Past Exams</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" checked="checked" value="">Miscellaneous Documents</label>
          </div>
          <input type="submit" value="Update Preferences">
          </form>
        </div>

      </div>
    </div>
    <div class="col-sm-9" style="background-color:#00cc7a; padding-top:20px;padding-bottom:20px; border-radius:10px">
      <div class="container-fluid">
        <form action="/list_page.php">
          <div class="input-group">
            <div class="input-group-btn search-panel">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="margin-top:-10px">
                <span id="search_concept">Search by</span> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#Title">Title</a></li>
                <li><a href="#Author">Author</a></li>
                <li><a href="#ISBN">ISBN</a></li>
                <li class="divider"></li>
                <li><a href="#Prof">Professor</a></li>
                <li><a href="#Course Name/Number">Course Name/Number</a></li>
                <li><a href="#Major/Field">Major/Field</a></li>
                <li><a href="#College">College</a></li>
                <li class="divider"></li>
                <li><a href="#all">Anything</a></li>
              </ul>
            </div>
            <input type="hidden" name="search_param" value="Title" id="search_param">
            <input type="text" class="form-control" name="search_term" placeholder="Search term...">
            <span class="input-group-btn">
              <input class="btn btn-default" type="submit" value="Search">
            </span>
          </div>
        </form>
      </div>
    </div>
    </div>
  </div>
  <h1>Table 1</h1>
  <table class="data-table">
    <caption class="title">Sales Data of Electronic Division</caption>
    <thead>
      <tr>
        <th>NO</th>
        <th>ISBN</th>
        <th>CUSTOMER</th>
        <th>DATE</th>
        <th>AMOUNT</th>
      </tr>
    </thead>                                                                                                                  <<tbody>         
  <?php
    $no   = 1;
    $total  = 0;
	include_once 'connect-to-database.php';
    $sql = "SELECT * FROM Buyer_Wants_Book WHERE UID = ".$_SESSION["UID"]." ;";
    $result = mysqli_query($conn,$sql);
    //$resultcheck = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result))
    {
      $amount  = $row['Desired_price'] == 0 ? '' : number_format($row['Desired_price']);
      echo '<tr>
          <td>'.$no.'</td>
          <td>'.$row['ISBN'].'</td>
          <td>'.$row['UID'].'</td>
          <td>'.$row['Timestamp'].'</td>
          <td>'.$amount.'</td>
        </tr>';
      $total += $row['amount'];
      $no++;
    }?>
    </tbody>
    
    <tfoot>
      <tr>
        <th colspan="4">TOTAL</th>
        <th><?=number_format($total)?></th>
      </tr>
    </tfoot>
  </table>
</body>
</html>


      }

    }
  ?>

    
    

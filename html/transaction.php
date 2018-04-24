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
  <script>
  $(document).ready(function(){
    $('#message_button').click(function(event) {
            $('#message').text("");
            $('#to').attr("value", $('#seller-username').text());
            $('#modal-title').text("Compose New Message");
        }
      );
    });
  </script>
</head>
<body>
<div id="navbar" style="margin-top:50px;">
</div>
	<div class="container-fluid with-navbar">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-3">
				<div class="container-fluid" style="background-color:black; border-radius:20px">
					<?php
					include_once 'connect-to-database.php';
					$query = "SELECT B.ISBN, B.Name, B.Description, B.ImgURL, N.Author, N.Edition FROM Book_Listing BL, Book B, Book_NAE N WHERE BL.LID='".$_POST['LID']."' AND BL.ISBN = B.ISBN AND B.ISBN=N.ISBN;";
					$result=mysqli_query($conn, $query);
					$book_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo "<h3 style='color:white'>".$book_info["Name"]."</h3>
					<h4 style='color:white'>".$book_info["Author"]."</h4>
					<img src='".$book_info["ImgURL"]."' alt='Book Image' style='width:100%'>
					<h4 style='color:white'>Edition: ".$book_info["Edition"]."</h4>
					<p style='color:white'>".$book_info["Description"]."</p>";
					?>
				</div>
			</div>
			<div class="col-sm-7" style="background-color:#00cc7a; border-radius:20px; color:white">
				<h2>Purchase Information:</h2>
				<hr>
				<?php
					include_once 'connect-to-database.php';
					$query="SELECT * FROM Listing L, Book_Listing BL, Seller S, Book B WHERE L.LID=BL.LID AND L.LID='".$_POST["LID"]."' AND S.UID=L.Seller_UID AND B.ISBN=BL.ISBN;";
					$result=mysqli_query($conn, $query);
					$list_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo "<div class='containter-fluid' style='background-color:white; color:black; border-radius:20px; margin:5px'>
						<div class='row'>
							<div class='col-sm-6'>
								<h3 style='font-size:40px; padding-top:10px' align='center'>Sale Price:</h3>
							</div>
							<div class='col-sm-6'>
								<h3 style='font-size:60px' align='center'>$".$list_info["Price"]."</h3>
							</div>
						</div><h4 align='center'>";
						if($list_info["Price"]>$list_info["Avg_price"]){
							echo "This price is $".($list_info["Price"]-$list_info["Avg_price"])." <b>above</b> the average price for this book.</h4>";
						}
						elseif($list_info["Price"]<$list_info["Avg_price"]){
							echo "This price is $".($list_info["Avg_price"]-$list_info["Price"])." <b>below</b> the average price for this book.</h4>";
						}
						else{
							echo "This price matches the average price for this book.</h4>";
						}
						echo "<hr>
						<div class='row' style='background-color:white; color:black; border-radius:20px; margin-right:5px; margin-left:5px; margin-bottom:-10px;'>
							<div class='col-sm-4'>
								<h3 style='font-size:30px; margin-top:-10px;' align='center'>Quality: ".$list_info["Quality"]."</h3>
							</div>
							<div class='col-sm-8'>
								<h3 style='font-size:30px; margin-top:-10px;' align='center'>Seller rating: ";
								for ($j=0; $j<floor(floatval($list_info["Seller_rating"])); $j=$j+1){
											echo "<img src='img/star.png' style='white-space: nowrap; width:30px; margin-bottom:0px'>";
										}
									echo "</h3><h3 style='font-size:30px; margin-top:-10px;' align='center'>".$list_info["Seller_rating"]."/5 stars
								</h3>
							</div>
						</div><hr>";
						if($list_info["Willing_to_meet"]==0){
							echo "<h3 style='margin-left:10px'>This seller has indicated that they <b>are not</b> willing to meet in person to exchange the book.</h3>
							<div class='row'>
								<div class='col-sm-3'></div>
								<div class='col-sm-6'>
									<form action='action_buy.php' method='POST'>
										<input type='hidden' name='LID' value='".$list_info["LID"]."'>
										<input type='hidden' name='Avg_price' value='".$list_info["Avg_price"]."'>
										<input type='hidden' name='Qty_sold' value='".$list_info["Qty_sold"]."'>
										<input type='hidden' name='Max_Price_Ever' value='".$list_info["Max_Price_Ever"]."'>
										<input type='hidden' name='Min_price_ever' value='".$list_info["Min_price_ever"]."'>
										<input type='hidden' name='Price' value='".$list_info["Price"]."'>
										<input type='hidden' name='ISBN' value='".$list_info["ISBN"]."'>
										<input class='btn btn-primary' type='submit' value='Buy Directly' style='width:100%; margin-right:0px; margin-left:0px; color:white;'>
									</form>
								</div>
								<div class='col-sm-3'></div>
							</div>
							";
						}
						else{
							echo "<h3 style='margin-left:10px'>This seller has indicated that they <b>are</b> willing to meet in person to exchange the book</h3>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-sm-6'>
										<form action='action_buy.php' method='POST'>
											<input type='hidden' name='LID' value='".$list_info["LID"]."'>
											<input type='hidden' name='Avg_price' value='".$list_info["Avg_price"]."'>
											<input type='hidden' name='Qty_sold' value='".$list_info["Qty_sold"]."'>
											<input type='hidden' name='Max_Price_Ever' value='".$list_info["Max_Price_Ever"]."'>
											<input type='hidden' name='Min_price_ever' value='".$list_info["Min_price_ever"]."'>
											<input type='hidden' name='Price' value='".$list_info["Price"]."'>
											<input type='hidden' name='ISBN' value='".$list_info["ISBN"]."'>
											<input class='btn btn-primary' type='submit' value='Buy Directly' style='width:100%; margin-right:0px; margin-left:0px; color:white;'>
										</form>
									</div>
									<div class='col-sm-6'>
                    <button id=\"message_button\" type=\"button\" class=\"btn btn-light btn-block\"
                       data-toggle=\"modal\" data-target=\"#compose-form\">Message
                       <p id=\"seller-username\" hidden>";
                       $seller_uid = $list_info["UID"];
                       $sql_statement = "SELECT UU.username FROM User_Username UU WHERE UU.UID={$seller_uid};";
                       $result = mysqli_query($conn, $sql_statement);
                       $seller_username = mysqli_fetch_row($result)[0];
                       echo "{$seller_username} </p>
                       </button>
  									</div>
								</div>
							</div>
							";
						}

					echo "</div>";

				?>
			</div>
			<div class="col-sm-1"></div>
		</div>
	</div>
  <div class="modal fade" id="compose-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="modal" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 id="modal-title" class="modal-title w-100 font-weight-bold">Compose New Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal_form" action="action_send.php" method="post" role="form">
              <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                      <i class="fa fa-envelope prefix grey-text"></i>
                      <label>To</label>
                      <input type="text" id="to" name="to" value="" class="form-control validate">
                  </div>

                  <div class="md-form mb-4">
                      <i class="fa fa-lock prefix grey-text"></i>
                      <label>Message</label>
                      <textarea rows='5' type="text" name="message" id="message" class="form-control validate"></textarea>
                  </div>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button type="submit" name="action" value="save" class="btn btn-default">Save as Draft </button>
                <button type="submit" name="action" value="send" class="btn btn-default">Send</button>
              </div>
              <?php
				session_start();
				include_once 'connect-to-database.php';
				$query="SELECT * FROM Listing L, Book_Listing BL, Seller S, Book B WHERE L.LID=BL.LID AND L.LID='".$_POST["LID"]."' AND S.UID=L.Seller_UID AND B.ISBN=BL.ISBN;";
				$result=mysqli_query($conn, $query);
				$list_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
				 echo "<input type=\"hidden\" name=\"LID\" value=\"".$list_info["LID"]."\">
						<input type=\"hidden\" name=\"Avg_price\" value=\"".$list_info["Avg_price"]."\">
						<input type=\"hidden\" name=\"Qty_sold\" value=\"".$list_info["Qty_sold"]."\">
						<input type=\"hidden\" name=\"Max_Price_Ever\" value=\"".$list_info["Max_Price_Ever"]."\">
						<input type=\"hidden\" name=\"Min_price_ever\" value=\"".$list_info["Min_price_ever"]."\">
						<input type=\"hidden\" name=\"Price\" value=\"".$list_info["Price"]."\">
						<input type=\"hidden\" name=\"ISBN\" value=\"".$list_info["ISBN"]."\">";
              ?>
             
            </form>
        </div>
    </div>
  </div>
</body>

</html>

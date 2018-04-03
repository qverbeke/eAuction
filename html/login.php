<!DOCTYPE html>

<html lang="en">
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
	$(function() {
    //When the login button is pressed (not the LOG IN button)
		$('#login-form-link').click(function(e) {
      //Have login form fade in and register form fade out
			$("#login-form").delay(100).fadeIn(100);
			$("#register-form").fadeOut(100);
      //Make the login form have the class active so we know it is the active form
			$('#register-form-link').removeClass('active');
      $("#error-text").hide();
			$(this).addClass('active');
      //prevent the default action of this event
			e.preventDefault();
		});
    //Similar to above function, when register button is pressed, witch to register form
		$('#register-form-link').click(function(e) {
			$("#register-form").delay(100).fadeIn(100);
			$("#login-form").fadeOut(100);
			$('#login-form-link').removeClass('active');
      //hide the error text
      $("#error-text").hide();
			$(this).addClass('active');
			e.preventDefault();
		});
	});
	</script>
</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6">
									<a href="#" class="active" id="login-form-link">Login</a>
								</div>
								<div class="col-xs-6">
									<a href="#" id="register-form-link">Register</a>
								</div>
							</div>
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
                  <p id="error-text" style="color:red; font-size: 13px;">
                    <?php
                    //create the text depending on the error in the url
                    //if there is a error message in the url
                      if(isset($_GET['error'])){
                        //if the error message is incorrect_password show the text incorrect password where the error text goes
                        if($_GET['error'] == 'incorrect_password'){
                          echo 'Incorrect Password';
                        }
                        if($_GET['error'] == 'username_not_found'){
                          echo 'Username not found.';
                        }
                        if($_GET['error'] == 'incorrect_confirm_password'){
                          echo 'Confirm password doesnt match';
                        }
                        if($_GET['error'] == 'duplicate_username_or_email'){
                          echo 'Username or email is already registered in our system.';
                        }
                      }
                    ?>
                  </p>
									<form id="login-form" action="action_sign_in.php" method="post" role="form" style="display: block;">
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
										</div>

																			<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
												</div>
											</div>
										</div>

									</form>
									<form id="register-form" action="action_register.php" method="post" role="form" style="display: none;">
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
										</div>
										<div class="form-group">
											<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
										</div>
											<div class="form-group">
											<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
										</div>
                    <div>
                      <div class="form-group">
                      <input type="text"  name="DOB" id="DOB" tabindex="1" class="form-control", placeholder="Date of birth (MM/DD/YY)" value="">
                    </div>
                    <div>
                      <div class="form-group">
                      <input type="text"  name="address" id="address" tabindex="1" class="form-control", placeholder="Address" value="">
                    </div>
                    <div>
                      <div class="form-group">
                      <input type="text"  name="gender" id="gender" tabindex="1" class="form-control", placeholder="Gender" value="">
                    </div>

										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</body>

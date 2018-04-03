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
			$(this).addClass('active');
      //prevent the default action of this event
			e.preventDefault();
		});
    //Similar to above function, when register button is pressed, witch to register form
		$('#register-form-link').click(function(e) {
			$("#register-form").delay(100).fadeIn(100);
			$("#login-form").fadeOut(100);
			$('#login-form-link').removeClass('active');
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
									<form id="login-form" action="https://phpoll.com/login/process" method="post" role="form" style="display: block;">
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
										</div>
										<div class="form-group text-center">
											<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
											<label for="remember"> Remember Me</label>
										</div>
																			<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="text-center">
														<a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
													</div>
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
                      <input type="text"  name="DOB" id="DOB" tabindex="1" class="form-control", placeholder="MM/DD/YY" value="">
                    </div>
                    <div>
                      <div class="form-group">
                      <input type="text"  name="address" id="address" tabindex="1" class="form-control", placeholder="Address" value="">
                    </div>
                    <div>
                      <div class="form-group">
                      <input type="text"  name="gender" id="gender" tabindex="1" class="form-control", placeholder="Gender" value="">
                    </div>

										<div class="form-group">
										  <label for="sel1">Institution:</label>
										  <select class="form-control" id="sel1">
											 <?php
												$list = array("Penn State","Rutgers lul","Carnegie Mellon");//will need to be modified
												sort($list);
												foreach($list as $listItem){
													echo "<option>".$listItem."</option>";
												}
											?>
										  </select>
										  <h5><a href="http://www.google.com" target="_blank">Can't find your institution? Click here</a></h5>
										</div>
										<div class="form-group">
										  <label for="sel1">Major:</label>
										  <select class="form-control" id="sel1">
											 <?php
												$list = array("Math","Comp Sci","Art");//will need to be modified
												sort($list);
												foreach($list as $listItem){
													echo "<option>".$listItem."</option>";
												}
											?>
										  </select>
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

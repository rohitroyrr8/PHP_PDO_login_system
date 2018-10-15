<?php  
	session_start();

	if(isset($_SESSION['logged_in'])){
		header('location: profile.php');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP PDO Login Using Jquery</title>
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">

</head>
<body>
<div class="">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#login_modal">Login</a>
    </span>
    <!-- Modal -->
	<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Login to your account</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div id="login-alert"></div>
	        <form action="auth.php" method="post" class="p-2 form" role="form" id="login-frm">
					<div class="form-group">
						<input type="email" id="log_email" name="email" class="form-control" required placeholder="Email-address" autocomplete="">
					</div>
					<div class="form-group">
						<input type="password" id="log_pass" name="password" class="form-control" required placeholder="Password" minlength="3">
					</div>
					<div class="form-group">
						<div class="custom-control custom-checked">
							<input type="checkbox" name="rem" class="custom-control-input" id="loginCheck">
							<label for="customCheck" class="custom-control-label">Remember Me</label>
							<a href="#" id="forget-link" class="float-right" data-toggle="modal" data-target="#forget_modal">Forget Password</a>
						</div>
					</div>
					<div class="form-group">
						<div class="fa fa-check done"></div>
            			<div class="fa fa-close failed"></div>
						<input type="submit" name="reset" id="reset-btn" value="Login" class="btn btn-primary btn-block submit">
					</div>
					<div class="form-group">
						<p class="text-center">New User? <a href="#" id="register-link">Click here</a></p>
					</div>
				</form>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="forget_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Forget Password? </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<p class="text-muted">Enter your email-address and we Send an reset link to your registered email-address to reset your password.</p>
	      	<div id="forget-alert"></div>
	        <form action="mail_password_link.php" method="post" class="p-2 form" role="form" id="forget-frm">
					<div class="form-group">
						<input type="email" id="forget_email" name="email" class="form-control" required placeholder="Enter registered email-address" autocomplete="">
					</div>
					<div class="form-group">
						<input type="submit" name="fotget_btn" id="forget-btn" value="Send Reset Link" class="btn btn-primary btn-block">
					</div>
					
				</form>
	      </div>
	      
	    </div>
	  </div>
	</div>

	<span class="navbar-text">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#register_modal">Register</a>
    </span>
    <!-- Modal -->
	<div class="modal fade" id="register_modal" tabindex="-1" role="dialog"  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Create an account</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div id="register-alert"></div>
	       <form action="register.php" method="post" class="p-2 form" role="form" id="register-frm">
					<div class="form-group">
						<input id="reg_name" type="text" name="name" class="form-control" required placeholder="Full Name" minlength="4">
					</div>
					
					<div class="form-group">
						<input type="email" name="email" class="form-control" required placeholder="Email-address">
					</div>
					<div class="form-group">
						<input type="password" name="pass" class="form-control" required placeholder="Password" id="pass" minlength="8">
					</div>
					<div class="form-group">
						<input type="password" name="cpass" class="form-control" required placeholder="Confirm Password" id="cpass" >
					</div>
					<div class="form-group">
						<div class="custom-control custom-checked">
							<input type="checkbox" name="rem" class="custom-control-input" id="registerCheck" required="">
							<label for="customCheck" class="custom-control-label">I agree to to the <a href="#">Terms and Conditions</a></label>
							
						</div>
					</div>
					<div class="form-group">
						<input type="submit" name="register" id="register-btn" value="Register" class="btn btn-primary btn-block">
					</div>
					<div class="form-group">
						<p class="text-center">Already Registered? <a href="#" id="login-link">Login here</a></p>
					</div>
				</form>
	      </div>
	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>

  </div>
</nav>
</div>

<div class="container mt-4">
<div class="jumbotron">
  <h1 class="display-4">Hello, There!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Join Today</a>
</div>
</div>

<script type="text/javascript" src="public/js/jquery.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>

</body>
</html>
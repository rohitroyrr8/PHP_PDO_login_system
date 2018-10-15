<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reset Password - PDO Login using PHP and JQuery</title>
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
      <a class="nav-link" href="index.php" >Login</a>
    </span>	
  </div>
</nav>
</div>

<div class="container mt-4">

<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6 ">
		<div class="jumbotron">
	  	<h3>Reset Password</h3>
		 
		<div id="reset-alert"></div>
		<form action="update_reset_password.php" method="post" class="p-2 form" role="form" id="register-frm" class="">
					
					<div class="form-group">
						<input type="password" name="npassword" class="form-control" required placeholder="New Password"  minlength="3">
					</div>
					<div class="form-group">
						<input type="password" name="cpassword" class="form-control" required placeholder="Confirm Password"  >
					</div>
					<input type="hidden" name="id" value="<?=$_GET['id']?>">
					<input type="hidden" name="code" value="<?php echo $_GET['code']?>">
					<div class="form-group">
						<input type="submit" name="reset" id="reset-btn" value="Reset Password" class="btn btn-primary btn-block">
					</div>
		</form>
		</div>
	</div>
	<div class="col-lg-3"></div>
</div>	
</div>

<script type="text/javascript" src="public/js/jquery.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>

</body>
</html>
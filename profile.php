<?php  
	session_start();

	if(!isset($_SESSION['logged_in'])){
		header('location: index.php?Access Denined');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home page - PDO Login using PHP and JQuery</title>
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
      <a class="nav-link" href="logout.php" >Logout</a>
    </span>
    
  </div>
</nav>
</div>

<div class="container mt-4">

<div class="row">
	<div class="col-lg-8">
		<div class="jumbotron">
		  <h1 class="display-4">Welcome, <?= $_SESSION['logged_in']['name'] ?>!</h1>
		  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
		  <hr class="my-4">
		  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
		  
		</div>
	</div>
	<div class="col-lg-4 " style="    padding-left: 65px;">
		<h3>Change Password</h3>
		<div id="change-password-alert"></div>
		<form action="change_password.php" method="post" class="p-2 form" role="form" id="register-frm" class="">
					<div class="form-group">
						<input type="password" name="password" class="form-control" required placeholder="Old Password"  minlength="3">
					</div>
					<div class="form-group">
						<input type="password" name="npassword" class="form-control" required placeholder="New Password"  minlength="3">
					</div>
					<div class="form-group">
						<input type="password" name="cpassword" class="form-control" required placeholder="Confirm Password"  >
					</div>
					
					<div class="form-group">
						<input type="submit" name="register" id="register-btn" value="Change Password" class="btn btn-primary btn-block">
					</div>
					
				</form>
	</div>
</div>	
</div>

<script type="text/javascript" src="public/js/jquery.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>

</body>
</html>
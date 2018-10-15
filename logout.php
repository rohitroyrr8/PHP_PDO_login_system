<?php 
	require_once('includes/init.php');

	if(isset($_SESSION['logged_in'])){
		$_SESSION = [];

		//forcefully expiring cokkie
		setcookie(session_name(), session_id(), time()-1000, "/");

		//this delete the session file from server
		session_destroy();

		header('location: index.php');
		exit;
	}else{
		header('location: index.php?please login to your account');
		exit;
	}

?>
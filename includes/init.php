<?php 
	session_start();

	session_regenerate_id(true);
	require_once 'connection.php';
	//require_once __DIR__.'/../vendor/autoload.php';
	require_once __DIR__.'/../functions/function.php';
	require_once __DIR__.'/../classes/User.php';
	

?>
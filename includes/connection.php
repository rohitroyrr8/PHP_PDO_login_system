<?php 

require_once __DIR__.'/../app/config.php';
try {
	$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";", DB_USER, DB_PASSWORD);	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Error while connecting to database');
}

?>
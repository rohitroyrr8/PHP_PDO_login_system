<?php 
	
	function debug($arg){
		echo '<pre>';
		print_r($arg);
		echo '</pre>';
		exit;
	}

	function generateCode(){
		return md5(random_bytes(32));
	}
?>
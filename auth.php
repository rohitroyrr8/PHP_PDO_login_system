<?php  

require_once 'includes/init.php';

$status = $user->login($_POST, $db);

if( $status === 'success'){
	echo json_encode([
		'alert' => 'login',
		'success' => 'success',
		'message' => '<p class="alert alert-success">Autheticated successfully</p>', 
		'redirect' => 1,
		'url' => 'profile.php'
	]);
}
else if( $status === 'error'){
	echo json_encode([
		'alert' => 'login',
		'error' => 'error', 
		'message' => '<p class="alert alert-danger">invalid email-id or passsword</p>'
	]);
}
else if( $status === 'missing_fields'){
	echo json_encode([
		'alert' => 'login',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">All fields are  mandatory</p>']);
}else{
	echo json_encode([
		'alert' => 'login',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">No accout found with that email-address</p>']);
}
?>
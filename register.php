<?php  

require_once 'includes/init.php';

$status = $user->register($_POST, $db);

if( $status === 'success'){
	echo json_encode([
		'alert' => 'register',
		'success' => 'success',
		'message' => '<p class="alert alert-success">Regisration successfully</p>', 
		'url' => 'profile.php']);
}
else if( $status === 'email_exists'){
	echo json_encode([
		'alert' => 'register',
		'error' => 'error', 
		'message' => '<p class="alert alert-danger">Account already exists</p>'
	]);
}
else if( $status === 'missing_fields'){
	echo json_encode([
		'alert' => 'register',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">All fields are  mandatory</p>']);
}
else if( $status = 'mismatch_password'){
	echo json_encode([
		'alert' => 'register',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Passsword does not match</p>']);
}
else{
	echo json_encode([
		'alert' => 'register',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Problem while creating your account</p>']);
}
?>
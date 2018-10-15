<?php  

require_once 'includes/init.php';

$status = $user->changePassword($_POST, $db);

if( $status === 'success'){
	echo json_encode([
		'alert' => 'change-password',
		'success' => 'success',
		'message' => '<p class="alert alert-success">Password changed successfully</p>', 
		'url' => 'profile.php']);
}

else if( $status === 'missing_fields'){
	echo json_encode([
		'alert' => 'change-password',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">All fields are  mandatory</p>']);
}

else if( $status = 'mismatch_password'){
	echo json_encode([
		'alert' => 'change-password',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Password does not match</p>']);
}

else if( $status = 'incorrect_password'){
	echo json_encode([
		'alert' => 'change-password',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Incorrect Old Password</p>']);
}
else{
	echo json_encode([
		'alert' => 'change-password',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Problem while changing password.</p>']);
}
?>
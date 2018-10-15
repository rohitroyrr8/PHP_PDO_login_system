<?php  

require_once 'includes/init.php';

$status = $user->resetPassword($_POST, $db);

if( $status === 'success'){
	echo json_encode([
		'alert' => 'reset',
		'success' => 'success',
		'message' => '<p class="alert alert-success">Password Reset Successfully</p>' 
		//'redirect' => 1,
		//'url' => 'profile.php'
	]);
}
else if( $status === 'error'){
	echo json_encode([
		'alert' => 'reset',
		'error' => 'error', 
		'message' => '<p class="alert alert-danger">Something went wrong. Please try again</p>'
	]);
}
else if( $status === 'missing_fields'){
	echo json_encode([
		'alert' => 'reset',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">All fields are  mandatory</p>']);
}

else if( $status === 'incorrect_code' OR $status === 'incorrect_id'  ){
	echo json_encode([
		'alert' => 'reset',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">This link has been has been expired. Try again</p>']);
}
else if( $status === 'mismatch-password'){
	echo json_encode([
		'alert' => 'reset',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Password does not match</p>']);
}
else{
	echo json_encode([
		'alert' => 'reset',
		'error' => 'error',
		'message' => '<p class="alert alert-success">'.$status.'</p>']);
}
?>
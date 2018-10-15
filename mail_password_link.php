<?php  

require_once 'includes/init.php';

$status = $user->mailResetPassword($_POST, $db);

if( $status === 'success'){
	echo json_encode([
		'alert' => 'forget',
		'success' => 'success',
		'message' => '<p class="alert alert-success">Autheticated successfully</p>', 
		'redirect' => 1,
		'url' => 'profile.php'
	]);
}
else if( $status === 'not_found'){
	echo json_encode([
		'alert' => 'forget',
		'error' => 'error', 
		'message' => '<p class="alert alert-danger">No account found with this email address</p>'
	]);
}
else if( $status === 'missing_fields'){
	echo json_encode([
		'alert' => 'forget',
		'error' => 'error',
		'message' => '<p class="alert alert-danger">Email address fields are  mandatory</p>']);
}else{
	echo json_encode([
		'alert' => 'forget',
		'error' => 'error',
		'message' => '<p class="alert alert-success">'.$status.'</p>']);
}
?>
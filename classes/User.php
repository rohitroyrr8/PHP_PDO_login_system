<?php 
 

 /**
  * 
  */
 class User 
 {
 	
 	public function login($user, $db){

 		if(empty($user['email']) OR empty($user['password'])){
 			return 'missing_fields';
 		}

 		$sql = "SELECT * FROM users WHERE email =?";
 		$statement = $db->prepare($sql);

 		if (is_object($statement)) {
 			# code...
 			$statement->bindParam(1, $user['email'], PDO::PARAM_STR);
 			$statement->execute();

 			if($row = $statement->fetch(PDO::FETCH_OBJ)){
 				
 				if(password_verify($user['password'], $row->password)){
 				//if($user['password'] == $row->password){
 					$_SESSION['logged_in'] = [
						'id' =>  $row->id,
						'name' =>  $row->name,
						'email' => $row->email

 					];

 					return 'success';
 				}

 				return 'error';
 			}
 		}
 	}

 	public function mailResetPassword($user, $db){
 		//check email exists or not is database
 		//if email field is missing

 		if(!$user['email']){
 			return 'missing_fields';
 		}

 		else if(!$this->emailExists($user['email'], $db)){
 			return 'not_found';
 		}

 		$sql = "SELECT * FROM users WHERE email =?";

 		$statement = $db->prepare($sql);
 		if(is_object($statement)){
 			$statement->bindParam(1, $user['email'], PDO::PARAM_STR);
 			$statement->execute();

 			if($row = $statement->fetch(PDO::FETCH_OBJ)){
 				$hash = SHA1(random_bytes(32));
 				$reset_link = 'reset_password.php?id='.$row->id.'&code='.$hash;
 				// return $reset_link;

 				$sql = "UPDATE users SET verification_code = ? WHERE id = ?";
 				$statement = $db->prepare($sql);

 				if(is_object($statement)){
 					$statement->bindParam(1, $hash, PDO::PARAM_STR);
 					$statement->bindParam(2, $row->id, PDO::PARAM_INT);
 					$statement->execute();

 					if($statement->rowCount() == 1){
						return $reset_link;
					}
 					
 				}
 			}
 		}
 		

 	}

 	function resetPassword($user, $db){

 		// All form data recieved
 		// user id is valid
 		// verfication code is valid
 		// new password and confirm password is matched
 		

 		//debug($user);

 		if(empty($user['npassword']) OR empty($user['cpassword']) OR empty($user['id']) OR empty($user['code'])){
 			return 'missing_fields';
 		}
 		else if($user['npassword'] !== $user['cpassword']){
 			return 'mismatch-password';
 		}
 		else if(!$this->idExists($user, $db)){
 			return 'incorrect_id';
 		}else if(!$this->verficationCodeExists($user, $db)){
 			return 'incorrect_code';
 		}
 		else{
			$sql = "UPDATE users SET password = ? WHERE id = ? AND verification_code = ?";
			$statement =$db->prepare($sql);

			if(is_object($statement)){
				$hash = password_hash($user['npassword'], PASSWORD_DEFAULT);
				$statement->bindParam(1, $hash, PDO::PARAM_STR);
				$statement->bindParam(2, $user['id'], PDO::PARAM_INT);
				$statement->bindParam(3, $user['code'], PDO::PARAM_STR);
				$statement->execute();

				if($statement->rowCount() == 1){
					return 'success';
				}
			
	 		}
 		return 'error';
		}
 	}

 	public function idExists($user, $db){

 		$sql = "SELECT * FROM users WHERE id =?";

 		$statement = $db->prepare($sql);
 		if(is_object($statement)){
 			$statement->bindParam(1, $user['id'], PDO::PARAM_INT);
 			$statement->execute();

 			if($row = $statement->fetch(PDO::FETCH_OBJ)){
 				return true;
 			}else{
 				return false;
 			}
 		}
 		
 	}

 	public function verficationCodeExists($user, $db){

 		$sql = "SELECT * FROM users WHERE verification_code =? ";

 		$statement = $db->prepare($sql);
 		if(is_object($statement)){
 			$statement->bindParam(1, $user['code'], PDO::PARAM_STR);
 			$statement->execute();

 			if($row = $statement->fetch(PDO::FETCH_OBJ)){
 				return true;
 			}else{
 				return false;
 			}
 		}
 		
 	}

 	public function register($user, $db){

 		if(empty($user['name']) OR empty($user['email']) OR empty($user['pass']) OR empty($user['cpass'])){
 			return 'missing_fields';
 		}
 		else if($this->emailExists($user['email'], $db)){
 				return 'email_exists';
 		}
 		else if($user['pass'] !== $user['cpass']){
 				return 'mismatch_password';
 		}
 		else{
 			$sql = "INSERT INTO users (name, email, password, verification_code) VALUES (?, ?, ?, ?)";
 			$statement = $db->prepare($sql);

 			if(is_object($statement)){

 				$hash =  password_hash($user['pass'], PASSWORD_DEFAULT);
 				$code = generateCode();
 				$statement->bindParam(1, $user['name'], PDO::PARAM_STR);
 				$statement->bindParam(2, $user['email'], PDO::PARAM_STR);
 				$statement->bindParam(3,$hash, PDO::PARAM_STR);
 				$statement->bindParam(4, $code, PDO::PARAM_STR);

 				$statement->execute();

 				if($statement->rowCount()){
 					session_regenerate_id(true);
 					return 'success';
 				}
 			}
 			return 'error';
 		}

 	}
 	function changePassword($user, $db){
		// all field are mandatory
 		//check whether password is valid
 		//confirm password and password should match
 		//debug($user);
 		if(empty($user['password']) OR empty($user['npassword']) OR empty($user['cpassword'])){
 			return 'missing_fields';
 		}

 		/*else if($user['npassword'] != $user['cpassword']){
 			return 'mismatch_password';
 		} */

 		else if( !$this->oldPasswordMatched($user['password'], $db)){
 			return 'incorrect_password';
 		}
 		else{
			$sql = "UPDATE users SET password = ? WHERE id = ?";
			$statement =$db->prepare($sql);

			if(is_object($statement)){
				$hash = password_hash($user['npassword'], PASSWORD_DEFAULT);
				$statement->bindParam(1, $hash, PDO::PARAM_STR);
				$statement->bindParam(2, $_SESSION['logged_in']['id'], PDO::PARAM_STR);
				$statement->execute();

				if($statement->rowCount() == 1){
					return 'success';
				}
			}
 			return 'error';
 		}
 	}

 	function oldPasswordMatched($password, $db){
 		$sql = "Select * from users where id = ?";
 		$statement = $db->prepare($sql);

 		if(is_object($statement)){

 			$statement->bindParam(1, $_SESSION['logged_in']['id'], PDO::PARAM_INT);
 			$statement->execute();

			if($row = $statement->fetch(PDO::FETCH_OBJ)){
 				if(password_verify($password, $row->password)){
 					return true;
 				}
 			}
		}
		return false;
 	}

 	function emailExists($email, $db){
 		$sql = "SELECT * FROM users WHERE email =?";

 		$statement = $db->prepare($sql);
 		if(is_object($statement)){
 			$statement->bindParam(1, $email, PDO::PARAM_STR);
 			$statement->execute();

 			if($row = $statement->fetch(PDO::FETCH_OBJ)){
 				return $row;
 			}
 		}
 		return false;
 	}
 }

 $user = new User();
?>
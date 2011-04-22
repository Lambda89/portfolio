<?php

include(dirname(__FILE__).'/Application.php');

/**
* 
*/
class Users extends Application
{
	public static $user;
	
	/*
		Factory
	*/
	
	static function setUser()
	{
		session_start();
		
		if (isset($_SESSION['user_id'])) {
			$data = parent::query("SELECT `id` 
									FROM `users` 
									WHERE `id`='{$_SESSION['user_id']}'
									LIMIT 1");
			
			if ($data[0]['id']) {
				Users::$user = $_SESSION['user_id'];
			}
			else {
				Users::$user = null;
			}			
		}
		else {
			Users::$user = null;
		}
	}
	
	static function getUser()
	{
		return Users::$user;
	}
	
	/*
		Get/Set database-data
	*/
	
	static function getUserData() 
	{
		$id = Users::getUser();
		
		$id = parent::escape($id, "sql");
		
		$data = parent::query("SELECT * 
								FROM `users` 
								LEFT OUTER JOIN `ticket_data`
								ON users.id = ticket_data.user_id
								WHERE users.id = '$id' 
								LIMIT 1
							");
		
		return $data[0];
	}
	
	//Gets all sells_object items
	
	static function getAllItems() {
				
		$data = parent::query("SELECT *
								FROM `sells_objects`
							");
								
		return $data;	
	}
	
	//Gets all user_object items
	
	static function getUserItems() {
		$id = Users::getUser();
		
		$id = parent::escape($id, "sql");
		
		$data = parent::query("SELECT *
								FROM `user_objects`
								WHERE `user_id` = '$id'
								AND `approve` = '1'
							");
							
		return $data;
	}
	
	//Sets data in users-table 
	
	static function setUserData($id, $hash) {
		
		$id = parent::escape($id, "sql");
		
		foreach ($hash as $key => $value) {
			if ($value == "") {
				return "Ett fält lämnades tomt. ".$key;
			}
			
			$hash[$key] = parent::escape($value, "both");
		}
		
		if (!parent::match($hash['ssn'], "ssn")) {
			return "Felaktigt personnummer.";
		}
		else {
			include_once(dirname(__FILE__).'/../backend/helpers.php');
			
			$ssn_tmp = str_replace("-", "", $hash['ssn']);
			
			if (!luhn($ssn_tmp)) return "Inte ett svenskt personnummer.";
		}
		
		if (!parent::match($hash['email'], "email")) {
			return "Felaktig epost-adress.";
		}
		
		if (!parent::match($hash['phone'], "phone")) {
			return "Felaktigt telefonnummer.";
		}
		
		$update_query = "UPDATE `users`
							SET `name` = '{$hash['name']}', 
							`ssn` = '{$hash['ssn']}', 
							`email` = '{$hash['email']}', 
							`phone` = '{$hash['phone']}', 
							`country` = '{$hash['country']}'
							WHERE `id` = '$id'
							LIMIT 1";
							
		if (parent::query($update_query)) {
			return "Success";
		}
		else {
			return "Ett fel uppstod";
		}
		
		
	}
	
	static function setTicketData($id, $hash)
	{		
		$id = parent::escape($id, "sql");

		$verify_query = "SELECT `user_id`
						FROM `ticket_data`
						WHERE `user_id` = '$id'";
		
		$insert_query = "INSERT INTO `ticket_data`
						(`user_id`, `street_address`, `zipcode`, `city`, `allergies`)
						VALUES ('$id', '{$hash['street_address']}', '{$hash['zipcode']}', '{$hash['city']}', '{$hash['allergies']}')";
						
		$update_query = "UPDATE `ticket_data`
						SET `street_address` = '{$hash['street_address']}',
						`zipcode` = '{$hash['zipcode']}',
						`city` = '{$hash['city']}',
						`allergies` = '{$hash['allergies']}'
						WHERE `user_id` = '$id'
						LIMIT 1";
						
		$result = parent::query($verify_query);

		if (is_array($result)) {
			if (parent::query($update_query)) {
				return "Success";
			}	
		}
		else {
			if (parent::query($insert_query)) {
				return "Success";
			}
		}

		return "Någonting gick fel. Data har ej sparats.";
	}
	
	//Sets a user_object items
	
	static function setUserObject($hash) {
		$id = Users::getUser();
		
		$id = parent::escape($id, "sql");
		
		foreach ($hash as $key => $value) {
			if ($value == ("")) {
				return false;
			}
			
			$hash[$key] = parent::escape($value, "both");
		}
		
		$verify_query = "SELECT *
						FROM `user_objects`
						WHERE `object_id` = '{$hash['id']}'
						AND `user_id` = '$id'
						LIMIT 1";
		
		$update_query = "UPDATE `user_objects`
						SET `approve` = '{$hash['value']}'
						WHERE `object_id` = '{$hash['id']}'
						AND `user_id` = '$id'
						LIMIT 1";
						
		$insert_query = "INSERT INTO `user_objects`
						(`user_id`, `object_id`, `approve`)
						VALUES('$id', '{$hash['id']}', '{$hash['value']}')";
						
		$result = parent::query($verify_query);
		
		if (is_array($result)) {
			if (parent::query($update_query)) {
				return true;
			}	
		}
		else {
			if (parent::query($insert_query)) {
				return true;
			}
		}
						
		return false;
		
	}
	
	static function login($hash)
	{
		foreach ($hash as $key => $value) {
			if (empty($value)) {
				return "Ett eller flera fält lämnades tomt.";
			}
			
			$hash[$key] = parent::escape($value, 'sql');
		}
		
		$hash['password'] = parent::hash_string($hash['password'], "SHA512");
		
		$result = parent::query("SELECT `id`, `username`, `password` 
								FROM `users`
								WHERE LOWER(`username`) = LOWER('{$hash['username']}')
								AND `password` = '{$hash['password']}'
								LIMIT 1
							");
							
		if (is_array($result)) {
			foreach ($result as $keys => $users) {
				if ($users['id'] && $users['username'] == strtolower($hash['username']) && $users['password'] == $hash['password']) {
					
					session_start();
					
					if (is_numeric($users['id'])) {
						$_SESSION['user_id'] = intval(trim($users['id']));
					}
					else {
						self::logout();
						
						return "Användarkontot existerar inte.";
					}
					
					if ($_SESSION['user_id'] < 1 || $_SESSION['user_id'] > 800) {
						self::logout();
						
						return "Allvarligt intrångsförsök.";
					}
					
					return "Success";
				}
				else {
					return "Användarnamnet eller lösenordet matchar inte någon användare.";
				}
			}
		} else {
			return "Användarnamnet eller lösenordet matchar inte någon användare.";
		}

	}
	
	static function logout() {
		unset($_SESSION);
		
		session_destroy();
		
		return true;
	}
	
	static function register($hash)
	{
		foreach ($hash as $key => $value) {
			if (empty($value)) {
				return "Ett eller flera fält lämnades tomt.";
			}
			
			$hash[$key] = parent::escape($value, "both");
		}
		
		if (!parent::match($hash['ssn'], "ssn")) {
			return "Felaktigt personnummer.";
		} 
		else {
			include_once(dirname(__FILE__).'/../backend/helpers.php');
			
			$ssn_tmp = str_replace("-", "", $hash['ssn']);
			
			if (!luhn($ssn_tmp)) return "Inte ett svenskt personnummer.";
		}
		
		if (!parent::match($hash['eaddr'], "email")) {
			return "Felaktig epost-adress.";
		}
		
		if (!parent::match($hash['phone'], "phone")) {
			return "Felaktigt telefonnummer.";
		}
		
		if ($hash['password'] != $hash['confirm_password']) {
			return "Lösenordet och bekräftelsen är inte lika.";
		} else {
			$hash['password'] = parent::hash_string($hash['password'], "SHA512");
		}
		
		$columns = "`username`, `password`, `name`, `ssn`, `email`, `phone`, `country`";
		
		$values = "LOWER('".$hash['username']."'), '".$hash['password']."', '".$hash['name']."', 
				  '".$hash['ssn']."', '".$hash['eaddr']."', '".$hash['phone']."', '".$hash['country']."'";
		
		$result = parent::query("INSERT INTO `users`
								 ($columns)
								 VALUES($values)
								");
								
		if ($result == true) {
			return "Success";
		}
		else {
			return "Registreringen misslyckades. Vänligen försök igen, eller kontakta webmaster om problemet kvarstår.";
		}
		
	}
	
	static function verifyUserData($id) {
		$id = parent::escape($id, "sql");
		
		$result = parent::query("SELECT *
									FROM `users` AS u
									INNER JOIN `ticket_data` AS td
									ON u.id = td.user_id
									WHERE u.id = '$id'");
		
		if (strlen($result[0]['name']) < 4) return false;
		if (!parent::match($result[0]['email'], "email")) return false;
		
		
		return "Success";
	}
	
	static function setNewPassword($email)
	{	
		$email = trim($email);
		
		$email = parent::escape($email, "sql");
		
		$user = parent::query("SELECT `id`, `username`, `email`
								FROM `users`
								WHERE `email` = '$email'
								LIMIT 1");
		
		if ($user[0]['id'] && $user[0]['email'] == $email) {
				
			$new_password = "";
			$chars = "abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUV1234567890";
			$c_len = strlen($chars);
				
			for ($i=0; $i < 10; $i++) { 
				$c = rand(0, $c_len-1);
				$new_password .= $chars[$c];
			}
				
			$topic = "New password - Confusion 2011.";
				
			$message = "Username: ".$user['username']."\n Password: ".$new_password;
				
			$password = parent::hash_string($new_password, "SHA512");
				
			$update_query = "UPDATE `users`
							SET `password` = '$password'
							WHERE `id` = '{$user['id']}'
							AND `email` = '{$user['email']}'
							LIMIT 1";
				
			if (parent::query($update_query)) {
				mail($user['email'], $topic, $message);
				
				return "Success";
			}
			else {
				return "Ett allvarligt fel uppstod. Ditt lösenord har inte återställts.";
			}
		}
		else {
			return "Användaren existerar inte.";
		}
	}
}


?>
<?php

require_once('Application.php');

/**
* 
*/
class Users extends Application
{
	
	public function login($hash)
	{
		
		$app = new Application();
		
		//Clean username, hash password
		
		$username = $app->clean($hash['username']);
		$password = $app->hash($hash['pwd']);
		
		//Find username and password in database
		
		$row = $app->query("SELECT `id`, `username`, `password`, `email`, `is_admin`
							FROM `users`
							WHERE `username` = '$username'
							AND `password` = '$password'
							LIMIT 1");
		
		//Compare given data, to content in database. Grant session if correct. Else, kill session, return to login.
							
		if ($row[0]['id']) {
			if ($row[0]['username'] == $username && $row[0]['password'] == $password) {
				if ($row[0]['is_admin'] === '1') {
					//Admin
					$_SESSION['id'] = $row[0]['id'];
					$_SESSION['is_admin'] = true;
					return true;
				} else {
					//Standard user
					$_SESSION['id'] = $row[0]['id'];
					return true;
				}
			} else {
				unset($_SESSION);
				session_destroy();
				header('Location: ../login.php');
				die();
			}
		} else {
			unset($_SESSION);
			session_destroy();
			header('Location: ../login.php');
			die();
		}
		
	}
	
	public function register($hash)
	{
		foreach ($hash as $key => $value) {
			if ($value == "") {
				return false;
			}
		}
		
		$app = new Application();
		
		$username = $app->clean($hash['username']);
		$password = $app->hash($hash['pwd']);
		$conf = $app->hash($hash['conf-pwd']);
		$email = $app->clean($hash['eaddr']);
		$phone = $app->clean($hash['phone']);
		$first_name = $app->clean($hash['first-name']);
		$last_name = $app->clean($hash['last-name']);
		$interest_group = $app->clean($hash['interest-group']);
		$address = $app->clean($hash['address']);
		$postal_code = $app->clean($hash['postal-code']);
		$location = $app->clean($hash['location']);
		
		if ($password != $conf) {
			return false;
		}
		
		if (!preg_match('/^([a-zA-Z0-9-.+_])+@([a-zA-Z0-9-_])+\.([a-zA-Z0-9]{2,5})+$/', $email)) {
			return false;
		}
		
		$result = $app->query("INSERT INTO `users`
							   (`username`, `password`, `email`, `phone`, `first_name`, 
								`last_name`, `interest_group`, `address`, `postal_code`, `location`)
							   VALUES('$username', '$password', '$email', '$phone', '$first_name', '$last_name', 
							   '$interest_group', '$address', '$postal_code', '$location')");
		
		return $result;
		
	}
	
	public function validateSession()
	{
		$app = new Application();
		
		$session_id = $app->clean($_SESSION['id']);
		
		$row = $app->query("SELECT `id` 
						    FROM `users` 
						    WHERE `id` = '$session_id' 
						    LIMIT 1");
		
		if (!$row[0]['id']) {
			echo "NO ACCESS!";
			die();
		}
	}
	
	public function validateAdmin()
	{
		$app = new Application();
		
		if ($_SESSION['is_admin'] != true) {
			echo "NO ACCESS!";
			die();
		}
		
		$session_id = $app->clean($_SESSION['id']);
		
		$row = $app->query("SELECT `id` 
						    FROM `users` 
						    WHERE `id` = '$session_id' 
						    AND `is_admin` = 1 
						    LIMIT 1");
		
		if (!$row[0]['id']) {
			echo "NO ACCESS!";
			die();
		}
	}
	
	public function getUsers()
	{
		$app = new Application();
		
		$row = $app->query("SELECT users.*, COUNT(tickets.user_id)
							FROM `users`
							LEFT OUTER JOIN `tickets`
							ON users.id = tickets.user_id
							GROUP BY users.id
							ORDER BY users.id
							ASC");
							
		return $row;
	}
	
	public function getUserNameById($id)
	{
		$app = new Application();
		
		$id = $app->clean($id);
		
		$row = $app->query("SELECT `first_name`, `last_name`
							FROM `users`
							WHERE `id` = '$id'");
							
		return $row;
	}
	
	public function deleteUser($id)
	{
		$app = new Application();
		
		$id = $app->clean($id);
		
		$delete_user_query = "DELETE FROM `users`
							  WHERE `id` = '$id'
							  LIMIT 1";
							
		$delete_tickets_query = "DELETE FROM `tickets`
								 WHERE `user_id` = '$id'";
		
		if ($app->query($delete_user_query)) {
			if ($app->query($delete_tickets_query)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	}
	
	public function resetPassword($email, $topic, $message)
	{
		$app = new Application();
		
		$email = $app->clean($email);
		
		$row = $app->query("SELECT `email` FROM `users` WHERE `email` = '$email' LIMIT 1");
		
		if ($row[0]['email'] === $email) {
			$email = $row[0]['email'];
			
			$chars = 'abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ123456789';
			$length = strlen($chars)-1;

			for ($i=0; $i < 8; $i++) { 
				$j = rand(0, $length);

				$new_password .= $chars[$j];
			}
			
			$password = $app->hash($new_password);
			
			if ($app->query("UPDATE `users` SET `password` = '$password' WHERE `email` = '$email' LIMIT 1")) {
				if (mail($email, $topic, $message."\n\n".$password)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function mailUser($array)
	{
		mail($array['eaddr'], $array['topic'], $array['message']);
	}
	
}


?>
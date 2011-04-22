<?php

if (stristr($_SERVER['REQUEST_URI'], "model")) {
	header('Location: ../index.php');
	die();
}

session_start();

/**
* 
*/
class SessionModel
{
	private $session;
	
	function __construct()
	{
		//$this->session = $session;
	}
	
	function login($username, $password)
	{
		require_once('mainModel.php');
		
		$MM = new MainModel();
		
		$username = $MM->clean($username);
		$password = $MM->hash($password);
		
		$query = $MM->validate("admins", "name", "password", $username, $password);
		$result = $MM->query($query);
		$row = $MM->fetch($result);
		
		if ($row['id'] && ($row['name'] == $username && $row['password'] == $password)) {
			$_SESSION['is_admin'] = true;
			$_SESSION['name'] = $row['name'];
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			
			if (stristr($_SERVER['REQUEST_URI'], "/tests/") != true) {
				header('Location: ../index.php');
			}
			return true;
		} else {
			unset($_SESSION);
			echo "The given credentials are not an admin. Make sure you typed your username and password correctly.";
			return false;
		}	
		
	}
	
	function logout()
	{
		unset($_SESSION);
		session_destroy();
		header('Location: ../index.php');
	}
}


?>

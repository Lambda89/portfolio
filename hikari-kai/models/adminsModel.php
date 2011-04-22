<?php

if (stristr($_SERVER['REQUEST_URI'], "model")) {
	header('Location: ../index.php');
	die();
}

require_once('sessionModel.php');

/**
* 
*/
class AdminsModel
{
	private $admin;
	
	function __construct()
	{
		$this->admin = $admin;
	}
	
	function validateOrRedirectAdmin()
	{
		if ($_SESSION['is_admin'] === true) {
			return true;
		} else {
			unset($_SESSION);
			session_destroy();
			if (stristr($_SERVER['REQUEST_URI'], "/tests/") != true) {
				header('Location: ../index.php');
			}
			return false;
		}
	}
	
}


?>
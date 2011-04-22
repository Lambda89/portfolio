<?php

//Login handler file.

if (isset($_POST['submit_login'])) {
	
		session_start();
		require_once('../classes/Users.php');
		$usr = new Users();
	
		if ($usr->login($_POST)) {
			if ($_SESSION['is_admin'] != true) {
				header('Location: ../display.php');
			} else {
				header('Location: ../admin/index.php');
			}
		}
		
}

?>
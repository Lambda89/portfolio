<?php

if (isset($_POST['submit_new_password'])) {
	if (preg_match('/^([a-zA-Z0-9-.+_])+@([a-zA-Z0-9-_])+\.([a-zA-Z0-9]{2,5})+$/', $_POST['eaddr'])) {
		
		session_start();
		
		require_once('../classes/Language.php');
		
		$lan = new Language();
		
		require_once('../classes/Users.php');
		
		$usr = new Users();
		
		if ($usr->resetPassword($_POST['eaddr'], $lan->l('reset_topic', true), $lan->l('reset_message', true))) {
			header('Location: ../login.php');
		} else {
			header('Location: ../password_reset.php');
		}
	}
}

?>
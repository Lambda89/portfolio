<?php

//If a post is sent from the form to here, insert data

if (isset($_POST['submit_register'])) {
	
	//Call the relevant class
	
	session_start();
	require_once('../classes/Users.php');
	$usr = new Users();
	
	//Automatic login after succesful registration
	
	if ($usr->register($_POST)) {
		if ($usr->login($_POST)) {
			header('Location: ../terms.php');	
		} else {
			header('Location: ../login.php');
		}
	} else {
		header('Location: ../register.php');
		die();
	}
	
}

?>
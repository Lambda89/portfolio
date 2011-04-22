<?php

session_start();

if (!$_SESSION['id']) {
	die();
}

if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
	require('../classes/Users.php');
	$usr = new Users();
	
	$usr->deleteUser($_POST['user_id']);
}

?>
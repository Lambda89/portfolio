<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if (isset($_POST['eaddr']) && isset($_POST['message'])) {
	require('../classes/Users.php');
	$usr = new Users();
	
	$usr->mailUser($_POST);
}

?>
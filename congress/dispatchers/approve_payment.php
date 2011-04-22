<?php

session_start();

if (!$_SESSION['id']) {
	die();
}

if (isset($_POST['id']) && isset($_POST['user_id'])) {
	if (is_numeric($_POST['id']) && is_numeric($_POST['user_id'])) {
		require('../classes/Tickets.php');
		$tick = new Tickets();
		
		$tick->approvePayment($_POST['id'], $_POST['user_id']);
	}
}

?>
<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if (isset($_POST['id'])) {
	if (is_numeric($_POST['id'])) {
		require_once('../classes/Tickets.php');
		$tick = new Tickets();
		
		$tick->deleteTicketType($_POST['id']);
	}
}

?>
<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if (isset($_POST['title'])) {
	if (is_numeric($_POST['number_of_days'])) {
		require_once('../classes/Tickets.php');
		$tick = new Tickets();
		
		$tick->updateTicketType($_POST);
	}
}

?>
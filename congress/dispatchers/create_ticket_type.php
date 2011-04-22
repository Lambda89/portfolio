<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if (isset($_POST['title'])) {
	
	//If a post 
	
	if (is_numeric($_POST['number_of_days'])) {
		require('../classes/Tickets.php');
		$tick = new Tickets();
		
		$tick->insertTicketType($_POST);
	}
}

?>
<?php

if (isset($_POST['ticket_type'])) {
	require_once('../classes/Tickets.php');
	$tick = new Tickets();
	
	if ($tick->insertTicket($_POST)) {
		echo "Success";
	} else {
		echo "Failure";
	}
}
?>
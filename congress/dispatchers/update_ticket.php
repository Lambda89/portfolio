<?php

if (isset($_POST['ticket_type'])) {
	require('../classes/Tickets.php');
	$tick = new Tickets();
	
	$tick->updateTicket($_POST);
}

?>
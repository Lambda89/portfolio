<?php

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
	require('../classes/Tickets.php');
	$tick = new Tickets();
	
	$tick->deleteTicket($_POST['id'], $_POST['user_id']);
}

?>
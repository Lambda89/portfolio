<?php

session_start();

if (!is_numeric($_SESSION['user_id'])) {
	die();
}

echo '
	<a href="?action=ticket_manager" id="ticket-manager" class="top-link modal-link">'.__l('Biljett').'</a>
';

?>
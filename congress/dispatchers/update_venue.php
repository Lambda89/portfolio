<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if (isset($_POST['title'])) {
	if (is_numeric($_POST['cost'])) {
		require_once('../classes/Venues.php');
		$ven = new Venues();
		
		$ven->updateVenue($_POST);
	}
}

?>
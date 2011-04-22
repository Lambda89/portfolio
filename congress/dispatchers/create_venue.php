<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if (isset($_POST['title'])) {
	
	//If a post 
	
	if (is_numeric($_POST['cost'])) {
		require('../classes/Venues.php');
		$ven = new Venues();
		
		$ven->insertVenue($_POST);
	}
}

?>
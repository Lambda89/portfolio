<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: ../index.php');
}
	
	require('../models/sessionModel.php');

	$SM = new SessionModel();

	if (isset($_POST['login'])) {
		$SM->login($_POST['uname'], $_POST['pw']);
	}

?>

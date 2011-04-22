<?php

if (isset($_POST['submit-approval'])) {
	if (isset($_POST['approval'])) {
		session_start();
		$_SESSION['approval'] = true;
			
		header('Location: ../purchase.php');
		die();
	} 
}

header('Location: ../terms.php');

?>
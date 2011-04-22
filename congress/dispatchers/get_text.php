<?php

if (isset($_GET['label'])) {
	session_start();
	require('../classes/Language.php');
	$lan = new Language();
	echo json_encode($lan->l($_GET['label'], true));
}

?>
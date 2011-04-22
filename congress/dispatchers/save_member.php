<?php

if (isset($_POST['submit_membership'])) {
	session_start();
	
	require_once('../classes/Language.php');
	$lan = new Language();
	
	require_once('../classes/Members.php');
	$mem = new Members();
		
	$topic = $lan->l('membership_topic', true);
	$message = $lan->l('membership_message', true);
	
	$mem->saveMember($_POST, $topic, $message);
	
	header('Location: ../display.php');
}

?>
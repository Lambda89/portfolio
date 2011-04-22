<?php

if ($_POST['fetch'] == 'ajax') {
	
	include_once(dirname(__FILE__).'/../classes/Users.php');
	
	Users::setUser();
	
	include_once(dirname(__FILE__).'/helpers.php');
	
}

if ($id = Users::getUser()) {
	$r = Users::setTicketData($id, $_POST);
	
	echo $r;
}

?>


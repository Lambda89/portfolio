<?php

if ($_POST['fetch'] == 'ajax') {
	
	include_once(dirname(__FILE__).'/../classes/Users.php');
	
	Users::setUser();
	
	include_once(dirname(__FILE__).'/helpers.php');
	
}
	
$r = Users::setNewPassword($_POST['email']);

echo __l($r);

?>
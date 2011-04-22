<?php

if ($_POST['fetch'] == 'ajax') {
	
	include_once(dirname(__FILE__).'/../classes/Users.php');
	
	Users::setUser();
	
	include_once(dirname(__FILE__).'/helpers.php');
	
}

if ($user = Users::getUser()) {
	if (Users::setUserObject($_POST)) {
		echo "Success";
	} else {
		echo  __l('Ett fel uppstod');
	}
}

?>
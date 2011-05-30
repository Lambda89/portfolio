<?php

require(dirname(__FILE__) . '/../classes/user.class.php');

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "login") {
	unset($_REQUEST['action']);
	if ($user->login($_REQUEST)) {
		header('Location: ../sbadmin/index.php');
	}
	else {
		header('Location: ../sbadmin/login.php?error=true');
	}
}

?>
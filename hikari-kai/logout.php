<?php

if ($_SESSION['is_admin'] === true) {
	if ($_GET['action'] == "logout") {
		$SM->logout();
	}
}

?>

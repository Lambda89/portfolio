<?php

session_start();

require_once('classes/Language.php');
$lan = new Language();

if ($_SESSION['lang'] == "") {
	$_SESSION['lang'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	
	if (!in_array($_SESSION['lang'], $lan->languages)) {
		$_SESSION['lang'] = "en-uk";
	}
}

require_once('classes/DatesAndTimes.php');
$dt = new DatesAndTimes();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Hela Barns Kongress</title>
	
	<link rel="stylesheet" href="media/main.css" type="text/css" media="screen" title="Main CSS" charset="utf-8" />
	
	<script type="text/javascript" charset="utf-8" src="scripts/jquery.js"> </script>
	<script type="text/javascript" charset="utf-8" src="scripts/main.js"> </script>
	
</head>

<body>
	
	<div id="header">
		<span class="navigation"> <a id="login-link" href="login.php"> <?php echo $lan->l('log_in'); ?> </a> </span>
		<span class="navigation"> <a id="register-link" href="register.php"> <?php echo $lan->l('register'); ?> </a> </span>
		<?php if ($_SESSION['id']): ?>
			<span class="navigation"> <a id="display-link" href="display.php"> <?php echo $lan->l('see_tickets'); ?> </a> </span>
		<?php endif ?>
	</div>

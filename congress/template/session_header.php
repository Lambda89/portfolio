<?php

session_start();

require_once('classes/Users.php');
$usr = new Users();
if (stristr($_SERVER['REQUEST_URI'], "admin")) {
	$usr->validateAdmin();
} else {
	$usr->validateSession();
}

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
	<script type="text/javascript" charset="utf-8" src="scripts/simplemodal.js"> </script>
	
</head>

<body>
	
	<div id="header">
		<span class="navigation"> <a id="home-link" href="index"> <?php echo $lan->l('back_to_home'); ?> </a> </span>
		<span class="navigation"> <a id="display-link" href="display.php"> <?php echo $lan->l('see_tickets'); ?> </a> </span>
		<span class="navigation"> <a id="purchase-link" href="terms.php"> <?php echo $lan->l('purchase_tickets'); ?> </a> </span>
		<span class="navigation"> <a id="membership-link" href="membership.php"> <?php echo $lan->l('become_member'); ?> </a> </span>
		<span class="navigation"> <a href=""><?php echo $lan->l('newsletter'); ?></a> </span>
	</div>
	

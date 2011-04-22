<?php

session_start();

require_once('../classes/Users.php');
$usr = new Users();
$usr->validateAdmin();

require_once('../classes/Language.php');
$lan = new Language();

if ($_SESSION['lang'] == "") {
	$_SESSION['lang'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	
	if (!in_array($_SESSION['lang'], $lan->languages)) {
		$_SESSION['lang'] = "en-uk";
	}
}

require_once('../classes/DatesAndTimes.php');
$dt = new DatesAndTimes();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Administratör</title>
	
	<link rel="stylesheet" href="../media/main.css" type="text/css" media="screen" title="Main CSS" charset="utf-8" />
	
	<script type="text/javascript" charset="utf-8" src="../scripts/jquery.js"> </script>
	<script type="text/javascript" charset="utf-8" src="../scripts/admin.js"> </script>
	<script type="text/javascript" charset="utf-8" src="../scripts/simplemodal.js"> </script>
	
</head>

<body>
	
	<div id="header">
		<span class="navigation"> <a id="overview-link" href="index.php"> <?php echo $lan->l('overview', true); ?> </a> </span>
		<span class="navigation"> <a id="statistics-link" href="statistics.php"> <?php echo $lan->l('statistics', true); ?> </a> </span>
		<span class="navigation"> <a id="ticket-types-link" href="ticket_types.php"> <?php echo $lan->l('manage_ticket_types', true); ?> </a> </span>
		<span class="navigation"> <a id="venues-link" href="venues.php"> <?php echo $lan->l('manage_venues', true); ?> </a> </span>
		<span class="navigation"> <a id="end-date-link" href="end_date.php"> <?php echo $lan->l('end_date', true); ?> </a> </span>
	</div>

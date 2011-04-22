<?php

include(dirname(__FILE__).'/classes/Users.php');

Users::setUser();

if ($_GET['action'] == "logout") {
	if (Users::logout()) {
		Users::setUser();
		header('Location: /booking2/');
	}
}

include(dirname(__FILE__).'/backend/helpers.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<link rel="stylesheet" href="styles/application.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="styles/noscript.css" type="text/css" media="screen" charset="utf-8" />
	
	<link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" />

	<script type="text/javascript" charset="utf-8" src="scripts/jquery.js"> </script>
	<script type="text/javascript" charset="utf-8" src="scripts/simplemodal.js"> </script>
	<script type="text/javascript" charset="utf-8" src="scripts/application.js"> </script>

	<title><?php echo $_SERVER['HTTP_HOST'].ucwords(str_replace("/", " | ", str_replace(".php", "", $_SERVER['PHP_SELF']))); ?></title>
	
</head>

<body>
	
	<div id="wrapper">
		
		<?php require(dirname(__FILE__).'/modals.php'); ?>
		
		<div id="header">
			<h1 class="header1"><a href="?key=index" id="index"><img src="logo_date.png" /></a></h1>
		</div>
				
		<div id="links">
			<?php if (!Users::getUser()): ?>
			<a href="?action=login" id="login" class="top-link modal-link"> <?php __l('Logga in'); ?> </a>
			<a href="?action=register" id="register" class="top-link modal-link shifted-link"> <?php __l('Registrera'); ?> </a>
			<a href="?key=help" id="help" class="top-link shifted-link"> <?php __l('Hjälp'); ?> </a>
			<?php else: ?>
			<a href="?key=help" id="help" class="top-link"> <?php __l('Hjälp'); ?> </a>
			<?php endif; ?>
			<a href="?key=info" id="info" class="top-link shifted-link"> <?php __l('Information'); ?> </a>
			<?php if (Users::getUser()) include('backend/get_user_tabs.php'); ?>
		</div>
		
		<div id="content">
			<div id="content-area">
				<noscript>
					<?php
					
						if ($_GET['action'] == "login") {
							require_once('login.php');
						}
						else if ($_GET['action'] == "register") {
							require_once('register.php');
						}
						else if ($_GET['action'] == "ticket") {
							require_once('backend/get_ticket_data_form.php');
						}
						else if ($_GET['key'] == "info" || $_GET['key'] == "tickets" || $_GET['key'] == "index") {
							echo '<div class="text">';
							require_once('backend/get_site_text.php');
							echo '</div>';
						} 
						else {
							$_GET['key'] = "index";
							echo '<div class="text">';
							require_once('backend/get_site_text.php');
							echo '</div>';
						}
					
					?>
				</noscript>
				
			</div>
			
			<div id="content-footer">
				
			</div>
		</div>
	
		<div id="footer">
			<p id="footer-paragraph"> <a href="http://www.confusion.nu"> www.confusion.nu </a> - Rickard Lund, 2011 </p>
		</div>
		
	</div>
	</body>
</html>

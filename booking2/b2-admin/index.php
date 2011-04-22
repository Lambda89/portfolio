<?php

	include(dirname(__FILE__).'/../classes/Admin.php');
	
	Admin::setAdmin();
	
	include(dirname(__FILE__).'/../backend/helpers.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<link rel="stylesheet" href="../styles/application.css" type="text/css" media="screen" title="Main stylesheet" charset="utf-8" />
	
	<link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
	
	<script type="text/javascript" charset="utf-8" src="../scripts/jquery.js"> </script>
	<script type="text/javascript" charset="utf-8" src="../scripts/simplemodal.js"> </script>
	<script type="text/javascript" charset="utf-8" src="../scripts/admin_application.js"> </script>

	<title><?php echo $_SERVER['HTTP_HOST'].ucwords(str_replace("/", " | ", str_replace(".php", "", $_SERVER['PHP_SELF']))); ?></title>
</head>

<body>

	<div id="wrapper">
		
		<div id="header">
			<h1 class="header1"><a href="" id="index"><img src="../logo_date.png" /></a></h1>
		</div>
		
		<div id="links">
			<a href="" id="login" class="top-link modal-link"> <?php __la('Logga in'); ?> </a>
			<a href="" id="help" class="top-link shifted-link"> <?php __la('Hjälp'); ?> </a>
			<a href="" id="info" class="top-link shifted-link"> <?php __la('Information'); ?> </a>
			<?php if (Admin::getAdmin()): ?>
			<a href="" id="edit-help" class="top-link shifted-link"> <?php __la('Redigera hjälp'); ?> </a>
			<a href="" id="edit-info" class="top-link shifted-link"> <?php __la('Redigera information'); ?> </a>
			<a href="" id="edit-users" class="top-link shifted-link"> <?php __la('Administrera biljetter'); ?> </a>
			<?php endif; ?>
		</div>
		
		<div id="content">
			<div id="content-area">
				
			</div>
		</div>
		
	</div>
	
	<div id="login-modal" class="modal container">
		<div class="modal-content">
		
			<a href="" id="close-login-modal" class="modal-closer simplemodal-close"> X </a>
		
			<h2> Logga in Admin</h2>
		
			<div class="line"> </div>
		
			<div class="modal-input"> 
				<label for="username">Användarnamn</label> <br /> 
				<input type="text" name="username" value="" id="username" /> 
			</div>
			<div class="modal-input"> 
				<label for="password">Lösenord</label> <br /> 
				<input type="password" name="password" value="" id="password" /> 
			</div>
			
			<div class="line"> </div>
		</div>

		<div id="login-bottom" class="modal-bottom">
			<div class="modal-input">
				<a href="" id="send-login" class="modal-submit"> Ok </a>
			</div>
			<div class="modal-input">
				<a href="" id="send-remember" class="modal-submit"> Glömt lösenord? </a>
			</div>
		</div>
 	</div>

</body>
</html>

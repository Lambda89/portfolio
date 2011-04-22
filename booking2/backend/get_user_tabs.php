<?php

if ($_GET['fetch'] == 'ajax') {
	
	include_once(dirname(__FILE__).'/../classes/Users.php');
	
	Users::setUser();
	
	include_once(dirname(__FILE__).'/helpers.php');
}

?>

<?php if (Users::getUser()): ?>
<a href="?action=ticket" id="ticket" class="top-link shifted-link"> <?php __l('Biljetten'); ?> </a>
<a href="?action=logout" id="logout" class="top-link shifted-link"> <?php __l('Logga ut'); ?> </a>
<?php endif; ?>
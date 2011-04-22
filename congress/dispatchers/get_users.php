<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

if ($_GET['relative'] == "true") {
	require('../classes/Users.php');
	$usr = new Users();
	
	require('../classes/Language.php');
	$lan = new Language();
}

$users = $usr->getUsers();
$length = count($users);

$table = 
'<table cellspacing="0" cellpadding="5" id="users-table"> <tr><th>'.$lan->l('name', true).'</th><th>'.$lan->l('no_of_tickets', true).'</th><th>'.$lan->l('phone', true).'</th><th>'.$lan->l('email', true).'</th><th><input type="checkbox" name="check-all-mail" value="" id="check-all-mail" />'.$lan->l('email', true).'</th></tr>';
	
for ($i=0; $i < $length; $i++) {
	if ($i % 2 == 0) {
		$bgcolor = "even";
	} else {
		$bgcolor = "odd";
	}
	 
	$table .= '<tr class="'.$bgcolor.'" id="'.$users[$i]['id'].'user"><td><a href="?" class="show-data" name="'.$users[$i]['id'].'show-data">'.$users[$i]['first_name'].' '.$users[$i]['last_name'].'</a></td><td><a href="tickets.php?id='.$users[$i]['id'].'">'.$users[$i]['COUNT(tickets.user_id)'].'</a></td><td>'.$users[$i]['phone'].'</td><td><a href="mailto:'.$users[$i]['email'].'" id="email-address'.$users[$i]['id'].'" name="'.$users[$i]['email'].'" class="mail-action">'.$users[$i]['email'].'</a></td><td><input type="checkbox" class="bulk-action" name="'.$users[$i]['id'].'_bulk_action" value="'.$users[$i]['id'].'" id="bulk-action'.$i.'" /></td></tr><tr class="hidden hidden-data '.$bgcolor.'" id="hidden-data'.$users[$i]['id'].'"><td>'.$users[$i]['interest_group'].'</td><td>'.$users[$i]['address'].'</td><td>'.$users[$i]['postal_code'].'</td><td>'.$users[$i]['location'].'</td><td><a href="?" class="delete-user-link" name="'.$users[$i]['id'].'delete" id="delete'.$users[$i]['id'].'">'.$lan->l('delete', true).'</a></td></tr>';
}

$table .= "</table>";

echo $table;


?>
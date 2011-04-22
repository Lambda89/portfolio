<?php

if (is_numeric($_GET['number_of'])) {
	session_start();
	require('../classes/Language.php');
	$lan = new Language();
	
	require('../classes/Tickets.php');
	$tick = new Tickets();
	
	$types = $tick->getTicketTypes();
	$length = count($types);
	
	for ($i=0; $i < $length; $i++) { 
		$options .= '<option value="'.$types[$i]['id'].'">'.$types[$i]['title'].', '.$types[$i]['number_of_days'].'</option>';
	}
	
	$string = "";

	for ($i=0; $i < $_GET['number_of']; $i++) { 
		$tt_input = 
		'<label for="ticket_type" id="tt_label'.$i.'">'.$lan->l('ticket_type', true).'</label>
		<select name="ticket_type" id="ticket-type'.$i.'">'.$options.'</select>';
		$fn_input = '<label for="first_name" id="fn_label'.$i.'">'.$lan->l('first_name', true).'</label>
		<input type="text" name="first_name" id="first-name'.$i.'" />';
		$ln_input = '<label for="last_name" id="ln_label'.$i.'">'.$lan->l('last_name', true).'</label>
		<input type="text" name="last_name" id="last-name'.$i.'" />';
		$ea_input = '<label for="eaddr" id="ea_label'.$i.'">'.$lan->l('email', true).'</label>
		<input type="text" name="eaddr" id="eaddr'.$i.'" />';
		$ph_input = '<label for="phone" id="ph_label'.$i.'">'.$lan->l('phone', true).'</label>
		<input type="text" name="phone" id="phone'.$i.'" />';
		$ad_input = '<label for="address" id="ad_label'.$i.'">'.$lan->l('address', true).'</label>
		<input type="text" name="address" id="address'.$i.'" />';
		$pc_input = '<label for="postal_code" id="pc_label'.$i.'">'.$lan->l('postal_code', true).'</label>
		<input type="text" name="postal_code" id="postal-code'.$i.'" />';
		$lc_input = '<label for="location" id="lc_label'.$i.'">'.$lan->l('location', true).'</label>
		<input type="text" name="location" id="location'.$i.'" />';

		$string .= 
		'<div class="ticket" id="ticket'.$i.'">'.$tt_input.$fn_input.$ln_input.$ea_input.$ph_input.$ad_input.$pc_input.$lc_input.'</div>';
	}

	echo $string;
}



?>
<?php

session_start();

if ($_GET['relative'] == "true") {
	require('../classes/Language.php');
	$lan = new Language();
}

$rel = true;

require('../classes/Tickets.php');
 
$tick = new Tickets();

$row = $tick->getTickets($_GET['id']);

$len = count($row);

for ($i=0; $i < $len; $i++) { 
	$price = $price + $row[$i]['cost'];
}

$html = '<span>'.$price.'</span><span class="hidden" id="user-id">'.$_GET['id'].'</span>';

for ($i=0; $i < $len; $i++) { 
	$html .= '
		<div class="ticket" id="ticket'.$row[$i]['id'].'" name="'.$row[$i]['id'].'ticket">
			<span id="ticket-type-label">'.$lan->l('ticket_types', $rel).'</span>
		 	<span class="data-field" id="ticket-type-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-ticket-type"><h3>'
			.$row[$i]['title'].', '.$lan->l('cost', $rel).': '.$row[$i]['cost'].' sek</h3></span>
			<span id="first-name-label">'.$lan->l('first_name', $rel).'</span>
			<span class="data-field" id="first-name-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-first-name">'
			.$row[$i]['first_name'].'</span>
			<span id="last-name-label">'.$lan->l('last_name', $rel).'</span>
			<span class="data-field" id="last-name-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-last-name">'
			.$row[$i]['last_name'].'</span>
			<span id="purchase-date-label">'.$lan->l('purchase_date', $rel).'</span>
			<span class="data-field" id="purchase-date-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-purchase-date">'
			.$row[$i]['purchase_date'].'</span>
			<span id="email-label">'.$lan->l('email', $rel).'</span>
			<span class="data-field" id="email-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-email">'.$row[$i]['email'].'</span>
			<span id="phone-label">'.$lan->l('phone', $rel).'</span>
			<span class="data-field" id="phone-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-phone">'.$row[$i]['phone'].'</span>
			<span id="address-label">'.$lan->l('address', $rel).'</span>
			<span class="data-field" id="address-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-address">'.$row[$i]['address'].'</span>
			<span id="postal-code-label">'.$lan->l('postal_code', $rel).'</span>
			<span class="data-field" id="postal-code-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-postal-code">'
			.$row[$i]['postal_code'].'</span>
			<span id="location-label">'.$lan->l('location', $rel).'</span>
			<span class="data-field" id="location-field'.$row[$i]['id'].'" name="'.$row[$i]['id'].'-location">'
			.$row[$i]['location'].'</span>
			<span class="controls"> 
				<a href="" class="edit-ticket-admin" id="'.$row[$i]['id'].'edit">'.$lan->l('edit', $rel).'</a> 
				<a href="" class="delete-ticket-admin" id="'.$row[$i]['id'].'delete">'.$lan->l('delete', $rel).'</a>
				<a href="" class="approve-payment-admin" id="'.$row[$i]['id'].'approval">'.$lan->l('approve', $rel).' '.$lan->l('payment', $rel).'</a> 
			</span>
		</div>
	';
}

echo $html;

?>
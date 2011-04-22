<?php

require('../classes/Tickets.php');
$tick = new Tickets();

echo json_encode($tick->getTicketTypes());

?>
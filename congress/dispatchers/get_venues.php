<?php

require('../classes/Venues.php');
$ven = new Venues();

echo json_encode($ven->getVenues());

?>
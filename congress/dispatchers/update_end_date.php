<?php

if (isset($_POST['date'])) {
	require('../classes/DatesAndTimes.php');
	$dt = new DatesAndTimes();
	
	$dt->setDate($_POST['date'], "primary");
}

?>
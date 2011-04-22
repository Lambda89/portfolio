<?php

session_start();

if ($_GET['relative'] == "true") {
	require_once('../classes/Language.php');
	require_once('../classes/DatesAndTimes.php');

	$lan = new Language();
}

require_once('../classes/DatesAndTimes.php');
$dt = new DatesAndTimes();

$row = $dt->getDate('primary');

echo 
'<form action="" method="post" accept-charset="utf-8">
	<p>'.$lan->l("current", true).': <span>'.$row[0]['date'].'</span></p>
	<p><input type="date" name="new_date" value="" id="new-date" /> </p>
	<p> <input type="submit" class="submit-button" name="submit_new_date" value="'.$lan->l('save', true).'" id="submit-new-date" /> </p>
</form>';

?>
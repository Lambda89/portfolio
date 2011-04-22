<?php

session_start();

if ($_SESSION['is_admin'] != true) {
	die();
}

//Get users, count number of them

if ($_GET['relative'] == "true") {
	require('../classes/Users.php');
	$usr = new Users();
}

$row = $usr->getUsers();
$length = count($row);

//Arrays that will contain the raw data

$cities_data = array();
$groups_data = array();

//Arrays that will contain counted and sorted data

$cities = array();
$groups = array();

//Loop through arrays, get the data we want

for ($i=0; $i < $length; $i++) {
	$cities_data[] = $row[$i]['location'];
}
for ($i=0; $i < $length; $i++) { 
	$groups_data[] = $row[$i]['interest_group'];
}

/* Rearrange data so that duplicates are counted, and merged, instead of printed */

foreach ($cities_data as $value) {
	if ($cities[$value]) {
		$cities[$value] += 1;
	} else {
		$cities[$value] = 1;
	}
}

foreach ($groups_data as $value) {
	if ($groups[$value]) {
		$groups[$value] += 1;
	} else {
		$groups[$value] = 1;
	}
}

$cities_string = '<div id="cities-statistic" class="statistics-presentation">';

foreach ($cities as $key => $value) {
	$cities_string .= '<p>'.$key." - ".$value.'</p>';
}

$cities_string .= "</div>";

$groups_string = '<div id="groups-statistic" class="statistics-presentation">';

foreach ($groups as $key => $value) {
	$groups_string .= '<p>'.$key." - ".$value.'</p>';
}

$groups_string .= "</div>";

echo $groups_string;
echo $cities_string;

?>
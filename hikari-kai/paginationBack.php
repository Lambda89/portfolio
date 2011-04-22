<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}

require_once('models/paginationModel.php');

$PM = new PaginationModel();

function checkGet($PM)
{
	if ($_GET['action'] == "next") {
		$PM->nextPage("posts", 5);
	} else if ($_GET['action'] == "prev") {
		$PM->prevPage("posts", 5);
	}
}

?>
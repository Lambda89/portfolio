<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}

require_once('models/mainModel.php');
require_once('models/sessionModel.php');

$MM = new MainModel();

function getDocuments($MM)
{
	$query = $MM->index('documents', 'id', 'DESC');
	$result = $MM->query($query);
	
	while ($row = $MM->fetch($result)) {
		echo '
			<p> <a href="uploads/'.$row['file_name'].'" id="'.$row['id'].'">'.$row['file_name'].'</a> </p>
		';
	}
}

?>
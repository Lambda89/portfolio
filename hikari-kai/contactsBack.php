<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}

require('models/mainModel.php');
require('models/sessionModel.php');

$MM = new MainModel();

	if ($_SESSION['is_admin'] === true) {
		if ($_GET['action'] == "delete" && is_numeric($_GET['id'])) {
			$id = $MM->clean($_GET['id']);
			$query = $MM->delete("contact_info", "id", $id);
			
			if ($MM->query($query)) {
				echo "<script type='text/javascript'> window.location = 'contacts.php'; </script>";
			} else {
				echo "Misslyckades";
			}
		}
	}

	function getContacts($MM)
	{
		$query = "SELECT * FROM `contact_info` INNER JOIN `positions` 
					ON contact_info.position_id = positions.p_id ORDER BY `position_id` ASC";
					
		$result = $MM->query($query);
		while ($row = $MM->fetch($result)) {
			echo "
			<div class='contact'>
				<h2 class='name_and_pos'>{$row['name']}, ".utf8_encode($row['position'])."</h2>
				<div class='bottom_line'> </div>
				<p> Email: {$row['email']} </p>
				<p> Telefon: {$row['phone']} </p>
				<div class='bottom_line'> </div>
				<p>".nl2br($row['other'])."</p>";
			if ($_SESSION['is_admin'] === true) {
				echo '<a class="manipulate delete" alt="Delete" href="contacts.php?action=delete&id='.$row['id'].'"> Radera </a>';
			}
			echo "</div> 
			";
		}
		
	}


?>
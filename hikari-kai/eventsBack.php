<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}
	
	require('models/mainModel.php');
	require('models/sessionModel.php');
	
	$MM = new MainModel();
	
	if ($_SESSION['is_admin'] === true) {
		if ($_GET['action'] == "delete") {
			if (is_numeric($_GET['id'])) {
				$id = $MM->clean($_GET['id']);
				$query = $MM->delete("events", "id", $id);
				if ($MM->query($query)) {
					header('Location: events.php');
				} else {
					echo "Misslyckades";
				}
			}
		}
	}

	function getEvents($MM)
	{
		$query = $MM->index("events", "id", "DESC");
		$result = $MM->query($query);

		while ($row = $MM->fetch($result)) {
			echo '
				<div class="post">
					<h2 class="topic">'.$row['event_name'].'</h2>
					<div class="bottom_line"> </div>
					<p class="this_post"><em>'.stripslashes(nl2br($row['event_description'])).'</em></p>
					<div class="bottom_line"> </div>
					<p>Plats och tid: '.$row['event_place'].', '.$row['event_time'].'!</p>';
					if ($_SESSION['is_admin'] === true) {
						echo '
							<div class="bottom_line"> </div>
							<a class="manipulate" alt="Delete" href="events.php?action=delete&id='.$row['id'].'"> X </a>
							<a class="manipulate" alt="Edit" href="edit.php?table=events&id='.$row['id'].'"> E </a>
						';
					}
			echo '</div>
			';
		}
	}
	
?>

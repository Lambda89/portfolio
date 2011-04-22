<?php

require_once('models/sessionModel.php');
require_once('models/mainModel.php');

$MM = new MainModel();

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}

if (isset($_POST['submit_edited_post']) && $_SESSION['is_admin'] === true) {
	$query = $MM->update("posts", '`topic`="'.$MM->clean($_POST['topic']).'", `post`="'.$MM->clean($_POST['post']).'"', 
																				"id", $MM->clean($_POST['id']));
																				
	if ($MM->query($query)) {
		header('Location: index.php');
	} else {
		echo "Misslyckades";
	}
}

if (isset($_POST['submit_edited_event']) && $_SESSION['is_admin'] === true) {
	$query = $MM->update("events", '`event_name`="'.$MM->clean($_POST['event_name']).
								   '", `event_description`="'.$MM->clean($_POST['event_description']).
								   '", `event_place`="'.$MM->clean($_POST['event_location']).
								   '", `event_time`="'.$MM->clean($_POST['event_time']).'"',
								"id", $MM->clean($_POST['id']));
	
	if ($MM->query($query)) {
		header('Location: events.php');
	} else {
		echo "Misslyckades";
	}
}

function printEditForm($MM, $table, $id)
{
	if ($table == "posts" && is_numeric($id)) {
		$query = $MM->show($table, "id", $id);
		$result = $MM->query($query);
		while ($row = $MM->fetch($result)) {
			echo '
				<div id="edit_post">
					<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<fieldset>
					<legend> Redigera bloggpost </legend>
						<p> Ämne: <br /> <input type="text" name="topic" value="'.stripslashes($row['topic']).'" id="topic" /> </p>
						<p> Text: <br /> <textarea name="post" rows="8" cols="27">'.stripslashes($row['post']).'</textarea>
						<p> <input type="hidden" name="author" value="'.$_SESSION['name'].'" id="author" /> </p>
						<p> <input type="hidden" name="id" value="'.$id.'" /> </p>
						<p><input type="submit" name="submit_edited_post" value="Redigera inlägg" class="submit" /></p>
					</fieldset>
					</form>
				</div>
			';
		}
	}
	
	if ($table == "events" && is_numeric($id)) {
		$query = $MM->show($table, "id", $id);
		$result = $MM->query($query);
		while ($row = $MM->fetch($result)) {
			echo '<div id="new_event">
					<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<fieldset>
					<legend> Nytt event - <a href="?" class="close"> X </a> </legend>
						<p> Namn: <br /> <input type="text" name="event_name" value="'.$row['event_name'].'" id="event_name" /> </p>
						<p> Beskrivning: <br /> 
							<textarea name="event_description" rows="8" cols="27">'.$row['event_description'].'</textarea> 
						</p>
						<p> Var?: <br /> 
							<input type="text" name="event_location" value="'.$row['event_place'].'" id="event_location" /> 
						</p>
						<p> När?: <br /> <input type="text" name="event_time" value="'.$row['event_time'].'" id="event_time" /> </p>
						<p> <input type="hidden" name="id" value="'.$id.'" /> </p>
						<p><input type="submit" name="submit_edited_event" value="Redigera event" class="submit" /></p>
					</fieldset>
					</form>
				</div>';
		}
	}
}

?>

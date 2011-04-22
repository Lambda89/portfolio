<?php

	if (stristr($_SERVER['REQUEST_URI'], '/admin')) {
		header('Location: index.php');
		die();
	}

	function getPositionsList($MM)
	{
		$query = "SELECT * FROM `positions` ORDER BY `p_id` ASC";
		$result = $MM->query($query);
		while ($row = mysql_fetch_assoc($result)) {
			echo "<option value={$row['p_id']}>".utf8_encode($row['position'])."</option>";
		}
	}
	
	if (isset($_POST['submit_post'])) {
		if ($_POST['nofill'] == "" && $_SESSION['is_admin'] === true) {
			
			$query = "SELECT * FROM `subscriptions` WHERE `subscription_id` = 1";
			$result = $MM->query($query);
			while ($row = $MM->fetch($result)) {
				mail($row['email'], "Prenumeration Hikari-Kai", "Notifikation: Det finns en ny bloggpost på hikari-kai.se.");
			}
			
			$topic = $MM->clean($_POST['topic']);
			$post = $MM->clean($_POST['post']);
			$author = $MM->clean($_POST['author']);
			$time = date("Y-m-d H:i:s");
			$query = $MM->create("posts", "`topic`, `post`, `author`, `created_at`", 
								"'".$topic."', '".$post."', '".$author."', '".$time."'");
			if ($MM->query($query)) {
				echo "<script type='text/javascript'> window.location = 'index.php'; </script>";
			} else {
				echo "<div class='message'> Misslyckades </div>";
			}
		}
	}
	
	if (isset($_POST['submit_event']) && $_SESSION['is_admin'] === true) {
		if ($_POST['nofill'] == "") {
			
			$query = "SELECT * FROM `subscriptions` WHERE `subscription_id` = 2";
			$result = $MM->query($query);
			while ($row = $MM->fetch($result)) {
				mail($row['email'], "Prenumeration Hikari-Kai", "Notifikation: Det finns en nytt event på hikari-kai.se.");
			}
			
			$name = $MM->clean($_POST['event_name']);
			$event = $MM->clean($_POST['event_description']);
			$place = $MM->clean($_POST['event_location']);
			$time = $MM->clean($_POST['event_time']);
			$query = $MM->create("events", "`event_name`, `event_description`, `event_place`, `event_time`", 
								"'".$name."', '".$event."', '".$place."', '".$time."'");
							
			if ($MM->query($query)) {
				echo "<script type='javascript'> window.location = 'events.php'; </script>";
			} else {
				echo "<div class='message'> Misslyckades </div>";
			}
		}
	}
	
	if (isset($_POST['submit_document']) && $_SESSION['is_admin'] === true) {
		if ($_POST['nofill'] == "") {
			$time = time();
			//$ = $MM->clean($_POST['variable'])
		}
	}
	
	if (isset($_POST['submit_contact']) && $_SESSION['is_admin'] === true) {
		if ($_POST['nofill'] == "") {
			$query = "SELECT `position_id` FROM `contact_info`";
 			$result = $MM->query($query);
			$posIds = $MM->fetch($result);
			
			$singleIds = array(1, 2, 3, 4, 7);
			
			if (is_numeric($_POST['contact_position'])) {
				if (in_array($_POST['contact_position'], $singleIds)) {
					if (in_array($_POST['contact_position'], $posIds)) {
						echo "<div class='message'> Det kan bara finnas en kontaktperson av denna typ. </div>";
						return false;
					}
				}
			} else {
				return false;
				die();
			}
			
			$name = $MM->clean($_POST['contact_name']);
			$posId = $MM->clean($_POST['contact_position']);
			$email = $MM->clean($_POST['contact_email']);
			$phone = $MM->clean($_POST['contact_phone']);
			$other = $MM->clean($_POST['contact_other']);
		
			$query = $MM->create("contact_info", "`name`, `position_id`, `email`, `phone`, `other`",
								"'".$name."', '".$posId."', '".$email."', '".$phone."', '".$other."'");		
							
			if ($MM->query($query)) {
				echo "<script type='javascript'> window.location = 'contacts.php' </script>";
			} else {
				echo "<div class='message'> Misslyckades </div>";
			}
		}
	}

?>

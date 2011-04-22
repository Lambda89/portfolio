<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}

require_once('models/mainModel.php');

$MM = new MainModel();

if (isset($_POST['delete_subscriptions'])) {
	if (preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}/', $_POST['ep_text'])) {
		$email = $MM->clean($_POST['ep_text']);
		
		$query = "DELETE FROM `subscriptions` WHERE `email` = '$email' LIMIT 2";
		if (mysql_query($query)) {
			echo '<div class="message"> Dina prenumerationer har raderats.';
		}
	}
}

if (isset($_POST['submit_subscription'])) {
	if (preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}/', $_POST['ep_text'])) {
		
		$bannedWords = array('kuk',
							'cock',
							'pussy',
							'subba',
							'slyna',
							'hora',
							'horor',
							'nigger',
							'neger',
							'blatte',
							'röv',
							'xxx',
							'runka',
							'fappa',
							'fap',
							'bitch',
							'luder',
							'slampa',
							'fuck',
							'tits',
							'boobs',
							'cunt',
							'knulla',
							'buttplug',
							'rimjob',
							'blowjob',
							'analsex',
							'balle',
							'onanera',
							'masturb',
							'flata',
							'jävel',
							'jävla',
							'horungar',
							'bajs',
							'whore',
							'våldt',
							'petting',
							'fitt',
							'ringmuskel',
							'heil',
							'rectum',
							'rektum',
							'spam',
							'href'	
							);
		
		$banned = false;
		
		foreach ($bannedWords as $bannedWord) {
			if (stristr($bannedWord, $_POST['ep_text'])) {
				$banned = true;
			}
		}
		
		if ($banned === false) {
			$email = $MM->clean($_POST['ep_text']);
			
			$query = $MM->show("subscriptions", "email", "'".$email."'");
			$result = $MM->query($query);
			$row = $MM->fetch($result);
			
			if ($row['email']) {
				echo '<div class="message"> Den angivna epostadressen finns redan i systemet. </div>';
				return false;
			}
			
			$blog = 1;
			$events = 2;
			
			if (isset($_POST['subscribe_posts'])) {
				$query = $MM->create("subscriptions", "`email`, `subscription_id`", "'".$email."', '".$blog."'");
				if ($MM->query($query)) {
					$response = "Du prenumererar nu på bloggposter";
				}
			}
			if (isset($_POST['subscribe_events'])) {
				$query = $MM->create("subscriptions", "`email`, `subscription_id`", "'".$email."', '".$events."'");
				if ($MM->query($query)) {
					if ($response) {
						$response .= " och events.";
					} else {
						$response = "Du prenumererar nu på event.";
					}
				}
			}
		} else {
			echo '<div class="message"> Din epostadress innehåller en av systemet förbjuden term. Detta är en del av Hikari Kais spam- skydd. Ta kontakt med en administratör om du har några frågor gällande detta.';
		}
	echo '<div class="message">'.$response.'</div>';
	}
}

?>
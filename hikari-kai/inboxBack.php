<?php

if (stristr($_SERVER['REQUEST_URI'], "Back")) {
	header('Location: index.php');
	die();
}

require_once('models/mainModel.php');

$MM = new MainModel();

if (isset($_POST['submit_suggestion'])) {
	if ($_POST['zipcode'] == "") {
		
	if (preg_match(	'/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}/', $_POST['ep_text']))
	{
		$from = 'Avsändare: '.$_POST['ep_text'];
	} 
	else {
		echo "<div class='message'> En giltig epostadress är ett krav. </div>";
		return false;
	}
		
		$query = $MM->index("admins", "id", "ASC");
		$result = $MM->query($query);
		while ($row = $MM->fetch($result)) {
			mail($row['email'], $_POST['topic'], $_POST['suggestion'], $from);
		}
		
		$banned = false;
		
		//Language filter. Both Swedish and English words that are supposed to be banned.
		
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

		foreach ($bannedWords as $bannedWord) {
			if(stristr($_POST['topic'], $bannedWord)) {
				$banned = true;
			}
			if(stristr($_POST['suggestion'], $bannedWord)) {
				$banned = true;
			}
		}
	
		if (!$_POST['topic'] == "" || !$_POST['suggestion'] =="") {
	
			if ($banned === false) {
				$topic = $MM->clean($_POST['topic']);
				$sugg = $MM->clean($_POST['suggestion']);
		
				$query = $MM->create("suggestions", "`topic`, `suggestion`", "'".$topic."', '".$sugg."'");
				if ($MM->query($query)) {
					header('Location: inbox.php');
				} else {
					echo "<div class='message'> Tyvärr sparades inte ditt förslag. Försök igen, och kontakta en admin om problemet kvarstår. </div>";
				}
			} else {
				echo "<div class='message'>Ditt förslag innehöll en av systemet förbjuden term. Systemet blockerar automatiskt kränkande och vulgära ord. Ditt förslag har därför inte sparats, och kommer inte att visas på sidan.</div>";
			}
		}
	}
}

function getSuggestions($MM)
{
	$query = $MM->index("suggestions", "id", "DESC LIMIT 10");
	
	$result = $MM->query($query);
	while ($row = $MM->fetch($result)) {
		echo '
		<div class="suggestion_frame">
			<h3 class="specific_topic">'.$row['topic'].'</h3>
			<div class="bottom_line"> </div>
			<p> <em>'.nl2br(stripslashes($row['suggestion'])).'</em> </p>
		</div>
		';
	}
}

?>

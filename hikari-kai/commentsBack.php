<?php

if (stristr($_SERVER['REQUEST_URI'], 'Back')) {
	header('Location: index.php');
	die();
}

if (!is_numeric($_GET['id'])) {
	header('Location: index.php');
	die();
}

require_once('models/mainModel.php');

$MM = new MainModel();

if (isset($_POST['submit_comment'])) {
	if ($_POST['zipcode'] == "") {
		if (preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}/', $_POST['ep_text'])) {
			
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
					if(stristr($_POST['nick'], $bannedWord)) {
						$banned = true;
					}
					if(stristr($_POST['ep_text'], $bannedWord)) {
						$banned = true;
					}
					if(stristr($_POST['comment'], $bannedWord)) {
						$banned = true;
					}
				}
			
		if ($banned === false) {	
			$nick = $MM->clean($_POST['nick']);
			$ep_text = $MM->clean($_POST['ep_text']);
			$comment = $MM->clean($_POST['comment']);
			$postId = $MM->clean($_POST['post_id']);
			
			$query = $MM->create("comments", "`nick`, `email`, `comment`, `post_id`", 
								"'".$nick."', '".$ep_text."', '".$comment."', '".$postId."'");
			
			if ($MM->query($query)) {
				header('Location: comments.php?id='.$postId);
			} else {
				echo "<div class='message'>Misslyckades med att spara kommentar. Kontakta en administratör om problemet kvarstår.</div>";
			}
		} else {
				echo "<div class='message'>Ditt förslag innehöll en av systemet förbjuden term. Systemet blockerar automatiskt kränkande och vulgära ord. Ditt förslag har därför inte sparats, och kommer inte att visas på sidan.</div>";			
		} 
			
		} else {
			echo '<div class="message"> Du har inte angett en korrekt epostadress. </div>';
			return false;
		}
	} else {
		echo '<div class="message"> Hack attempt! </div>';
		return false;
	}
}

function getPostAndComments($MM, $id)
{
	$query = $MM->show("posts", "id", $id);
	$result = $MM->query($query);
	while ($row = $MM->fetch($result)) {
		echo '
			<div class="post">
				<h2 class="topic">'.$row['topic'].'</h2> <span class="posted_at"><strong>['.$row['created_at'].']</strong></span>
				<div class="bottom_line"> </div>
				<p class="this_post"><em>'.stripslashes(nl2br($row['post'])).'</em></p>
				<div class="bottom_line"> </div>
				<p class="poster">Skrivet av: '.$row['author'].'</p>
			</div>
		';
	}
	
	echo '<p> <a href="" id="comment_link"> Klicka här för att kommentera! </a> </p>
	
	<form action="" method="post" accept-charset="utf-8" id="comment_form">
	<fieldset>
		<legend> Kommentar - <a href="?" class="close"> X </a> </legend>
		<p> <label for="nick">Nick:</label> <br /> <input type="text" name="nick" value="" id="nick" /> </p>
		<p> <label for="ep_text"> Epost (obligatoriskt): </label> <br /> <input type="text" name="ep_text" value="" id="ep_text" /> </p>
		<p> <label for="comment"> Kommentar: </label> <br /> <textarea name="comment" rows="8" cols="27" id="comment"> </textarea> </p>
		<p> 
			<input type="hidden" name="post_id" value="'.$_GET['id'].'" id="post_id" />
			<input type="hidden" name="zipcode" value="" id="zipcode" /> 
		</p>
		<p><input type="submit" name="submit_comment" value="Kommentera!" class="submit" /></p>
	</form>
	</fieldset>';
	
	$query = $MM->subIndex("comments", "post_id", $id, "id", "DESC");
	$result = $MM->query($query);
	echo '<div id="comments">';
	while ($row = $MM->fetch($result)) {
		echo '
			<div class="comment_frame">
				<p class="this_comment"><em>'.stripslashes(nl2br($row['comment'])).'</em></p>
				<div class="bottom_line"> </div>
				<p> Skrivet av: '.$row['nick'].'</p>
			</div>
		';
	}
	echo '</div>';
}

?>

<?php

	if (stristr($_SERVER['REQUEST_URI'], "Back")) {
		header('Location: index.php');
		die();
	}
	
	require('models/mainModel.php');
	require('models/sessionModel.php');

	$MM = new MainModel();
	$SM = new SessionModel();
	
	if ($_SESSION['is_admin'] === true) {
		if ($_GET['action'] == "delete") {
			if (is_numeric($_GET['id'])) {
				$id = $MM->clean($_GET['id']);
				$query = $MM->delete("posts", "id", $id);
				if ($MM->query($query)) {
					header('Location: index.php');
				} else {
					echo "Misslyckades";
				}
			}
		}
	}

	function getIndex($MM)
	{
		$query = "SELECT posts.*, COUNT(`post_id`) FROM `posts` LEFT OUTER JOIN `comments` ON posts.id = comments.post_id GROUP BY `id` ORDER BY `id` DESC LIMIT 5";
		$result = $MM->query($query);

		while ($row = $MM->fetch($result)) {
			echo '
				<div class="post">
					<h2 class="topic">'.$row['topic'].'</h2> <span class="posted_at"><strong>['.$row['created_at'].']</strong></span>
					<div class="bottom_line"> </div>
					<p class="this_post"><em>'.stripslashes(nl2br($row['post'])).'</em></p>
					<div class="bottom_line"> </div>
					<p class="poster">Skrivet av: '.$row['author'].'</p>';
					echo '<a class="manipulate comment" href="comments.php?id='.$row['id'].'"> Kommentarer ('.$row['COUNT(`post_id`)'].')</a>';
					if ($_SESSION['is_admin'] === true) {
						echo '
							<a class="manipulate delete" href="index.php?action=delete&id='.$row['id'].'"> Ta bort </a>
							<a class="manipulate" href="edit.php?table=posts&id='.$row['id'].'"> Redigera </a>
						';
					}
			echo '
				</div>
			';
			$next[] = $row['id'];
		}	
		$pageLinks = '<p id="page_links">';
		if (count($next) > 4) {
			$pageLinks .= '<a href="index.php?action=next&id='.end($next).'"> Äldre inlägg >> </a>';
		}
		$pageLinks .= '</p>';
		echo $pageLinks;
	}
	
?>

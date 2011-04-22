<?php

if (!$_GET['id']) {
	if (!$_GET['table']) {
		header('Location: index.php');
		die();
	}
}

require_once('editBack.php');

if ($_SESSION['is_admin'] != true) {
	header('Location: index.php');
	die();
}

?>
	<?php
	
		include('header.php');

	?>
	
	<div class="content" id="posts_HK">

		<?php
		
			printEditForm($MM, $_GET['table'], $_GET['id']);
		
		?>

	</div>

	<br id="clear" />

</div>

</body>
</html>

<?php

require_once('commentsBack.php');

?>

	<?php
	
		include('header.php');

	?>
	
	<div class="content" id="posts_HK">

		<div class="content_placer">
		<?php
		
			getPostAndComments($MM, $_GET['id']);
		
		?>
		</div>

	</div>

	<br id="clear" />

</div>

</body>
</html>

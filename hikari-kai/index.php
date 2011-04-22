<?php

require_once('indexBack.php');
require_once('logout.php');
require_once('paginationBack.php');

?>

	<?php
	
		include('header.php');

	?>
	
	<div class="content" id="posts_HK">

		<div class="content_placer">
		<?php
		
			if (isset($_GET['action'])) {
				checkGet($PM);
			} else {
				getIndex($MM);
			}
		
		?>
		</div>

	</div>

	<br id="clear" />

</div>

</body>
</html>

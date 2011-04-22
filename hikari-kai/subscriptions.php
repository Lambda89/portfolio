<?php

require_once('subscriptionsBack.php');

?>

	<?php
	
		include('header.php');

	?>
	
	<div class="content" id="posts_HK">

		<div class="content_placer">
			<form action="" method="post" accept-charset="utf-8">
				<fieldset>
				<legend> Prenumerationer </legend>
					<p>
						<label for="ep_text">Epost (obligatoriskt): </label>
						<input type="text" name="ep_text" value="" id="ep_text" />
					</p>
					<p>
						Jag vill prenumerera på:<br />
						<label for="subscribe_posts">Blogg</label>
						<input type="checkbox" name="subscribe_posts" value="" id="subscribe_posts" />
						<label for="subscribe_events">Event</label>
						<input type="checkbox" name="subscribe_events" value="" id="subscribe_events" />
					</p>
				

					<p><input type="submit" name="submit_subscription" value="Prenumerera" class="submit" /></p>
				</fieldset>
			</form>
			
			<form action="" method="post" accept-charset="utf-8" id="delete_subscriptions_form">
				<fieldset>
				<legend> Radera prenumeration </legend>
					<p>
						<label for="ep_text">Epost: </label>
						<input type="text" name="ep_text" value="" id="ep_text" />
					<p>
					<p><input type="submit" name="delete_subscriptions" value="Radera" class="submit" /></p>
				</fieldset>
			</form>
		</div>

	</div>

	<br id="clear" />

</div>

</body>
</html>

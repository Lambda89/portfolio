<?php

	if (stristr($_SERVER['REQUEST_URI'], '/admin.')) {
		header('Location: index.php');
	}

	echo '<div id="wrapper">
		
		<div id="admin_options">

				<div id="admin_panel">
					<a href="index.php?action=logout"> Logga ut </a>

					<form action="" method="post" accept-charset="utf-8">
						<label for="post">Blogg</label><input type="radio" name="new" value="post" id="post" />
						<label for="event">Event</label><input type="radio" name="new" value="event" id="event" />
						<label for="document">Dokument</label><input type="radio" name="new" value="document" id="document" />
						<label for="contact">Kontakt</label><input type="radio" name="new" value="contact" id="contact" />		
					</form>
				</div>

		<div class="content">';
		
					echo '
						<div id="new_post">
							<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<fieldset>
							<legend> Ny bloggpost - <a href="?" class="close"> X </a> </legend>
								<p> Ämne: <br /> <input type="text" name="topic" value="" id="topic" /> </p>
								<p> Text: <br /> <textarea name="post" rows="8" cols="27"></textarea>
								<p> <input type="hidden" name="author" value="'.$_SESSION['name'].'" id="author" /> </p>
								<input type="text" name="nofill" value="" class="nofill" />
								<p><input type="submit" name="submit_post" value="Nytt inlägg" class="submit" /></p>
							</fieldset>
							</form>
						</div>	

						<div id="new_event">
							<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<fieldset>
							<legend> Nytt event - <a href="?" class="close"> X </a> </legend>
								<p> Namn: <br /> <input type="text" name="event_name" value="" id="event_name" /> </p>
								<p> Beskrivning: <br /> <textarea name="event_description" rows="8" cols="27"></textarea> </p>
								<p> Var?: <br /> <input type="text" name="event_location" value="" id="event_location" /> </p>
								<p> När?: <br /> <input type="text" name="event_time" value="" id="event_time" /> </p>
								<input type="text" name="nofill" value="" class="nofill" />
								<p><input type="submit" name="submit_event" value="Nytt event" class="submit" /></p>
							</fieldset>
							</form>
						</div>

						<div id="new_document">
							<form action="admin.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<fieldset>
							<legend> Nytt dokument - <a href="?" class="close"> X </a> </legend>
								<input type="text" name="nofill" value="" class="nofill" />
								<p><input type="submit" name="submit_document" value="Nytt dokument" class="submit" /></p>
							</fieldset>
							</form>
						</div>

						<div id="new_contact">
							<form action="" method="post" accept-charset="utf-8">
							<fieldset>
							<legend> Ny kontaktperson - <a href="?" class="close"> X </a> </legend>
								<p> Namn: <input type="text" name="contact_name" value="" id="contact_name" />
								Position: <select name="contact_position" id="contact_position">';
								getPositionsList($MM);
						echo '</select>
								<p> Mail: <input type="text" name="contact_email" value="" id="contact_email" />
								Telefon: <input type="text" name="contact_phone" value="" id="contact_phone"></p>
								<p> Övrigt: <br /> <textarea name="contact_other" rows="8" cols="27"></textarea> </p>
								<input type="text" name="nofill" value="" class="nofill" />
								<p><input type="submit" name="submit_contact" value="Ny kontakt" class="submit" /></p>
							</fieldset>
							</form>
						</div>

		</div>

		</div>';
?>

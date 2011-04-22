<?php

require_once('inboxBack.php');

?>

	<?php
	
		include('header.php');

	?>
	
	<div class="content" id="inbox_HK">

		<div class="content_placer">
			
			<p class="info"> Här visas de senaste 10 inskickade förslagen. Du kan också ge förslag på hur Hikari Kai kan förbättras! </p>
			<p class="info"> Förslagslådan är helt anonym utåt, om så önskas. Epostadress är dock ett krav för att styrelsen ska kunna kontakta er och förklara varför era förslag behandlas på ett visst sätt.
			<p class="info"> Föreningen Hikari-Kai tar inget ansvar för det som skickas in. Allt innehåll som
			representerar våra medlemmars åsikter representerar inte nödvändigtvis föreningens åsikter.</p>
			<p class="info"> Ett språkfilter finns installerat, och blockerar en mängd ord som kan uppfattas som stötande och/eller kränkande.
			Vi tar inget ansvar ifall en utav våra medlemmar, eller någon utomstående, ändå lyckas kringgå systemet.</p>	
			<p> <a href="" id="suggestion"> Klicka här! </a> </p>

			<form action="" method="post" accept-charset="utf-8" id="suggestion_form">
			<fieldset>
				<legend> Förslagslådan - <a href="?" class="close"> X </a> </legend>
				<p> <label for="topic">Ämne:</label> <br /> <input type="text" name="topic" value="" id="topic" maxlength="50" /> </p>
				<p> <label for="suggestion">Text:</label> <br /> <textarea name="suggestion" rows="8" cols="27"></textarea> </p>
				<p> <label for="ep_text">Epost (obligatoriskt, visas aldrig på sidan):</label> <br /> <input type="text" name="ep_text" value="" id="ep_text" /> </p>
				<input type="text" name="zipcode" value="" class="zipcode" />
				<p> <input type="submit" name="submit_suggestion" value="Lämna förslag!" class="submit"> </p>
			</fieldset>
			</form>
			
			<?php getSuggestions($MM); ?>

		</div>

	</div>

	<br id="clear" />
	
</div>

</body>
</html>

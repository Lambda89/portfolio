<div id="footer">
	<div id="languages">
		<?php foreach ($lan->languages as $value): ?>
			<span class="language"> <a href="../dispatchers/change_language.php?language=<?php echo $value; ?>&amp;return_url=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
			<?php echo $value; ?> </a> </span>
		<?php endforeach ?>
	</div>

	<div id="modal" class="hidden">
		<span class="modal-text"><?php echo $lan->l('confirm', true); ?></span>
		<a href="?" class="modal-link simplemodal-close" id="no-delete"> <?php echo $lan->l('no', true); ?> </a>
		<a href="?" class="modal-link" id="yes-delete"> <?php echo $lan->l('yes', true); ?> </a>
	</div>

	<div id="modal-ticket" class="hidden">
		<span class="modal-text"><?php echo $lan->l('confirm', true); ?></span>
		<a href="?" class="modal-link simplemodal-close" id="no-delete-ticket"> <?php echo $lan->l('no', true); ?> </a>
		<a href="?" class="modal-link" id="yes-delete-ticket"> <?php echo $lan->l('yes', true); ?> </a>
	</div>
</div>

</body>
</html>

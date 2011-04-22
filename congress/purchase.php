<?php include('template/session_header.php'); ?>

<div id="wrapper">

<?php if ($dt->checkDate(date("Y-m-d"), "primary")): ?>
	<?php if ($_SESSION['approval'] === true): ?>
		<form action="purchase_tickets.php" method="post" accept-charset="utf-8" id="tickets_form">
			<fieldset id="no_of_tickets" class="hb_form_fieldset">
				<legend><?php echo $lan->l('no_of_tickets'); ?></legend>
				<select name="number" id="number">
					<?php
					for ($i=1; $i < 11; $i++) { 
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
				</select>
				<div id="tickets">

				</div>
			</fieldset>

			<p><input type="submit" class="submit-button" id="submit_purchase" name="submit_purchase" value="<?php echo $lan->l('purchase'); ?>"></p>

			<!-- Hidden values -->
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" id="user_id" />
		</form>
	<?php else: ?>
		<a href="terms.php"> <?php echo $lan->l('approval_required'); ?> </a>
	<?php endif ?>
<?php endif ?>

</div>

<?php include('template/footer.php'); ?>
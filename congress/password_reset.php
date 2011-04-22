<?php include('template/header.php'); ?>

<div id="wrapper">
	<form action="dispatchers/reset_password.php" method="post" accept-charset="utf-8">
		<p> <label for="eaddr"><?php echo $lan->l('email'); ?></label><br /><input type="text" name="eaddr" value="" id="eaddr" /> </p>		
		<p><input type="submit" class="submit-button" name="submit_new_password" value="<?php echo $lan->l('send'); ?>"></p>
	</form>
</div>

<?php include('template/footer.php'); ?>
<?php include('template/header.php'); ?>

<div id="wrapper">
	<form action="dispatchers/login_account.php" method="post" accept-charset="utf-8">
		<fieldset id="user-information" class="hb-form-fieldset">
			<p>
				<label for="username"><?php echo $lan->l('username'); ?></label> <br />
				<input type="text" name="username" value="" id="username" />
			</p>
			<p>
				<label for="pw"><?php echo $lan->l('pw'); ?></label> <br />
				<input type="password" name="pwd" value="" id="pwd" />
			</p>
			<p><input type="submit" class="submit-button" name="submit_login" id="submit_login" value="<?php echo $lan->l('log_in'); ?>"></p>
			<p> <a href="password_reset.php"> <?php echo $lan->l('forgot_password'); ?> </a > </p>
		</fieldset>
	</form>
</div>

<?php include('template/footer.php'); ?>
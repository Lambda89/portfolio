<?php include('template/header.php'); ?>

<div id="wrapper">

	<?php if ($dt->checkDate(date("Y-m-d"), "primary")): ?>
		<form action="dispatchers/register_account.php" method="post" accept-charset="utf-8">
			<fieldset id="user-information" class="hb-form-fieldset">
				<p>
					<label for="username"><?php echo $lan->l('username'); ?></label> <br />
					<input type="text" name="username" value="" id="username" />
				</p>
				<p>
					<label for="pw"><?php echo $lan->l('pw'); ?></label> <br />
					<input type="password" name="pwd" value="" id="pwd" />
				</p>
				<p>
					<label for="conf-pw"><?php echo $lan->l('conf_pw'); ?></label> <br />
					<input type="password" name="conf-pwd" value="" id="conf-pwd" />
				</p>
				<p>
					<label for="eaddr"><?php echo $lan->l('email'); ?></label> <br />
					<input type="text" name="eaddr" value="" id="eaddr" />
				</p>
				<p>
					<label for="phone"><?php echo $lan->l('phone'); ?></label> <br />
					<input type="text" name="phone" value="" id="phone" />
				</p>
				<p>
					<label for="first-name"><?php echo $lan->l('first_name'); ?></label> <br />
					<input type="text" name="first-name" value="" id="first-name" />
				</p>
				<p>
					<label for="last-name"><?php echo $lan->l('last_name'); ?></label> <br />
					<input type="text" name="last-name" value="" id="last-name" />
				</p>
				<p>
					<label for="interest-group"><?php echo $lan->l('interest_group'); ?></label> <br />
					<select name="interest-group" id="interest-group">
						<option value="Privatperson"><?php echo $lan->l('individual'); ?></option>
						<option value="Företag"><?php echo $lan->l('company'); ?></option>
						<option value="Förening"><?php echo $lan->l('association'); ?></option>
						<option value="Journalist"><?php echo $lan->l('journalist'); ?></option>
						<option value="Politiker"><?php echo $lan->l('politician'); ?></option>
						<option value="Läkare"><?php echo $lan->l('doctor'); ?></option>
						<option value="Forskare"><?php echo $lan->l('scientist'); ?></option>
						<option value="CAM-terapeut"><?php echo $lan->l('cam'); ?></option>
					</select>
				</p>
				<p>
					<label for="address"><?php echo $lan->l('address'); ?></label> <br />
					<input type="text" name="address" value="" id="address" />
				</p>
				<p>
					<label for="postal-code"><?php echo $lan->l('postal_code'); ?></label> <br />
					<input type="text" name="postal-code" value="" id="postal-code" />
				</p>
				<p>
					<label for="location"><?php echo $lan->l('location'); ?></label> <br />
					<input type="text" name="location" value="" id="location" />
				</p>
			</fieldset>
			<p><input type="submit" class="submit-button" name="submit_register" id="submit_register" value="<?php echo "Register"; ?>"></p>
		</form>
	<?php endif ?>
</div>

<?php include('template/footer.php'); ?>
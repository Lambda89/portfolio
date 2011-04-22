<?php include('../template/admin_header.php'); ?>
	<!-- End of header -->
	
<div id="wrapper">
	<!-- Start of form -->
	<form action="" method="post" accept-charset="utf-8">
		<p><label for="title"><?php echo $lan->l('title', true); ?></label><input type="text" name="title" value="" id="new-title" /></p>
		<p><label for="cost"><?php echo $lan->l('cost', true); ?></label><input type="text" name="cost" value="" id="cost" /></p>
		<p>
			<select name="venue-type" id="venue-type">
				<option value="Boende"><?php echo $lan->l('living', true); ?></option>
				<option value="Mat"><?php echo $lan->l('food', true); ?></option>
				<option value="Utflykt"><?php echo $lan->l('ventures', true); ?></option>
			</select>
		</p>
		<p><input type="submit" class="submit-button" id="create-venue" value="<?php echo $lan->l('save', true); ?>"></p>
	</form>
	<!-- End of form -->
	
	<!-- Start of list -->
	<div id="venues-area">
		<table border="1" cellspacing="5" cellpadding="5" id="venues-list">
			<tr>
				<th><?php echo $lan->l('title', true); ?></th>
				<th><?php echo $lan->l('cost', true); ?></th>
				<th><?php echo $lan->l('venue_type', true); ?></th>
				<th><?php echo $lan->l('edit', true); ?></th>
			</tr>
		</table>
		<noscript>
			<p> <?php echo $lan->l('javascript_required', true); ?> </p>
		</noscript>
	</div>
	<!-- End of list -->
</div>
	
	<!-- Start of footer -->
<?php include('../template/admin_footer.php'); ?>
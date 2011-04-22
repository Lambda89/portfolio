<?php include('../template/admin_header.php'); ?>
	<!-- End of header -->

<div id="wrapper">
	
	<!-- Start of form -->
	<form action="" method="post" accept-charset="utf-8">
		<p><label for="title"><?php echo $lan->l('title', true); ?></label><input type="text" name="title" value="" id="new-title" /></p>
		<p><label for="cost"><?php echo $lan->l('cost', true); ?></label><input type="text" name="cost" value="" id="new-cost" /></p>
		<p><label for="number_of_days"><?php echo $lan->l('number_of_days', true); ?></label>
			<select name="number_of_days" id="new-number-of-days">
				<?php
				 	for ($i = 1; $i < 4; $i++) {
						echo '<option value="'.$i.'">'.$i.'</option>';
					} 
				?>			
			</select>
		</p>
		<p><input type="submit" class="submit-button" id="create-ticket-type" value="<?php echo $lan->l('save', true); ?>"></p>
	</form>
	<!-- End of form -->
	
	<!-- Start of list -->
	<div id="ticket-types-area">
		<table border="1" cellspacing="5" cellpadding="5" id="ticket-types-list">
			<tr>
				<th><?php echo $lan->l('title', true); ?></th>
				<th><?php echo $lan->l('number_of_days', true); ?></th>
				<th><?php echo $lan->l('cost', true); ?> </th>
				<th><?php echo $lan->l('edit', true); ?></th>
				<th><?php echo $lan->l('delete', true); ?></th>
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
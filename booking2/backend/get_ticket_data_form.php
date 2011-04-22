<?php

if ($_GET['fetch'] == 'ajax') {
	
	include_once(dirname(__FILE__).'/../classes/Users.php');
	
	Users::setUser();
	
	include_once(dirname(__FILE__).'/helpers.php');
}

?>

<?php if (Users::getUser()): ?>
	<?php 
		$data = Users::getUserData(); 
		$items = Users::getAllItems();
		$user_items = Users::getUserItems();		
	?>
	
	<div id="ticket-sidebar">
		<?php __l('Betalningsinformation kommer att visas här då alla uppgifter är ifyllda.'); ?>
	</div>
	
	<div id="ticket-form">
		<input type="checkbox" value="1" id="activate-editing" /> 
		<label id="editing-label" for="activate-editing"><?php __l('Redigera'); ?></label>
		<div id="success-message"> </div>
		<form action="" method="post" accept-charset="utf-8">
		 	<p class="form-input">
				<label for="name" ><?php __l('Namn'); ?></label><br />
				<input type="text" class="text-edit" name="name" value="<?php echo $data['name']; ?>" id="name" readonly />
			</p>
			<p class="form-input">
				<label for="ssn" ><?php __l('Personnummer'); ?></label><br />
				<input type="text" class="text-edit" name="ssn" value="<?php echo $data['ssn']; ?>" id="ssn" readonly />
			</p>
			<p class="form-input">
				<label for="eaddr" ><?php __l('Epost'); ?></label><br />
				<input type="text" class="text-edit" name="email" value="<?php echo $data['email']; ?>" id="eaddr" readonly />
			</p>
			<p class="form-input">
				<label for="phone" ><?php __l('Telefon'); ?></label><br />
				<input type="text" class="text-edit" name="phone" value="<?php echo $data['phone']; ?>" id="phone" readonly />
			</p>
			<p class="form-input"> 
				<label for="street_address" ><?php __l('Gatuadress'); ?></label><br />
				<input type="text" class="text-edit" name="street_address" value="<?php echo $data['street_address'] ?>" id="street_address" readonly /> 
			</p>
			<p class="form-input">
				<label for="zipcode" ><?php __l('Postnr'); ?></label><br />
				<input type="text" class="text-edit" name="zipcode" value="<?php echo $data['zipcode']; ?>" id="zipcode" readonly />
			</p>
			<p class="form-input"> 
				<label for="city" ><?php __l('Stad'); ?></label><br />
				<input type="text" class="text-edit" name="city" value="<?php echo $data['city'] ?>" id="city" readonly /> 
			</p>
			<p class="form-input">
				<label for="country" ><?php __l('Land'); ?></label><br />
				<input type="text" class="text-edit" name="country" value="<?php echo $data['country']; ?>" id="country" readonly />
			</p>
			<p class="form-input">
				<label for="allergies"><?php __l('Allergier'); ?></label><br />
				<textarea class="text-edit" id="allergies" name="allergies" rows="8" cols="40"><?php echo $data['allergies']; ?>
				</textarea>
			</p>
			
			<?php foreach ($items as $key => $item): ?>
				<p class="form-input">
					<p>
						<label for="">
							<?php __l($item['item']) ?>, 
							<?php echo '
									<span class="item-price" id="'.$item['item'].'-price" 
										value="'.$item['cost'].'">'.$item['cost'].' sek</span>
								';
							?>
						</label>
						<span id="<?php echo 'status'.$item['id']; ?>"> </span>
						<?php if ($item['section'] == "primary"): ?>
								<input type="radio" class="cost-object" name="<?php echo 'object'.$item['id'] ?>" 
								value="<?php echo $item['cost']; ?>" id="<?php echo $item['section'] ?>" checked />
								<?php $cost = $cost + $item['cost']; ?>
						<?php else: ?>
							<?php
							 	if (is_array($user_items)) {
									foreach ($user_items as $key => $user_item) {
										
										$checked = '';
										
										if ($user_item['object_id'] == $item['id']) {
											$cost = $cost + $item['cost'];
											$checked = 'checked';
											
											break;
										}
									}
								}
							?>
							<input type="checkbox" class="cost-object" name="object'<?php echo $item['id']; ?>" 
							value="<?php echo $item['cost']; ?>" id="object<?php echo $item['id']; ?>" <?php echo $checked; ?> />
						<?php endif; ?>
					</p>
				</p>
			<?php endforeach ?>
			
			<div class="line"> </div> <br />

			<p class="form-input">
				<div id="sum"> 
					<?php __l('Totalsumma: '); ?> <span id="total-cost"> <?php echo $cost; ?> </span> <?php __l('sek'); ?>
				</div>
			</p> 
			
		</form>
	</div>
<?php else: ?>
	<p class="form-input"> <?php __l('Otillåtet intrång.'); ?> </p>
<?php endif; ?>
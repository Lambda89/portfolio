<div id="login-modal" class="modal container">
	<div class="modal-content" id="login-modal-content">
	
		<a href="" id="close-login-modal" class="modal-closer simplemodal-close"> X </a>
	
		<h2> Logga in </h2>
		
		<div class="modal-input"> 
			<label for="login-username">Användarnamn</label> <br /> 
			<input type="text" name="login-username" value="" id="login-username" /> 
		</div>
		<div class="modal-input"> 
			<label for="login-password">Lösenord</label> <br /> 
			<input type="password" name="login-password" value="" id="login-password" /> 
		</div>
		
	</div>
	
	<div id="login-error"> </div>

	<div id="login-bottom" class="modal-bottom">
		<div class="modal-input">
			<a href="" id="send-login" class="modal-submit"> Ok </a>
		</div>
		<div class="modal-input">
			<a href="" id="send-remember" class="modal-submit"> Glömt lösenord? </a>
		</div>
	</div>
</div>

<div id="register-modal" class="modal">
	
	<div class="modal-content">
		<a href="" id="close-register-modal" class="modal-closer simplemodal-close"> X </a>
	
		<h2> Registrera konto </h2>
						
		<div class="modal-input"> 
			<label for="username">Användarnamn</label> <br /> 
			<input type="text" name="username" value="" id="username" /> 
		</div>
		<div class="modal-input"> 
			<label for="password">Lösenord</label> <br /> 
			<input type="password" name="password" value="" id="password" /> 
		</div>
		<div class="modal-input"> 
			<label for="confirm-password">Bekräfta lösenord</label> <br /> 
			<input type="password" name="confirm-password" value="" id="confirm-password" /> 
		</div>
	
		<div class="line"> </div>
				
		<div class="modal-input"> 
			<label for="name">Namn</label> <br /> 
			<input type="text" name="name" value="" id="name" /> 
		</div>
		<div class="modal-input"> 
			<label for="ssn">Personnummer <br />
				<span class="modal-info-text"><?php __l('Endast för Svenska medborgare'); ?></span></label> <br /> 
			<input type="text" name="ssn" value="" id="ssn" />
		</div>
		<div class="modal-input"> 
			<label for="eaddr">Epost</label> <br /> 
			<input type="text" name="eaddr" value="" id="eaddr" /> 
		</div>
		<div class="modal-input"> 
			<label for="phone">Telefon</label> <br /> 
			<input type="text" name="phone" value="" id="phone" /> 
		</div>
		<div class="modal-input"> 
			<label for="country">Land</label> <br />
			<select name="country" id="country">
				<?php
					foreach ($helper_countries as $iso => $country) {
						if ($country == 'Sverige') {
							$selected = 'selected="selected"';
						}
						else {
							$selected = '';
						}
					
						echo '<option '.$selected.' value="'.$iso.'">'.$country.'</option>';
					}
			
				?>
			</select>
		</div>
	</div>
	
	<div id="register-error"> </div>
	
	<div id="register-bottom" class="modal-bottom">
		<div class="modal-input">
			<a href="" id="send-register" class="modal-submit"> Ok </a>
		</div>
		
		<div class="modal-input">
			<a href="" id="send-info" class="modal-submit"> Mer information </a>
		</div>
	</div>
</div>
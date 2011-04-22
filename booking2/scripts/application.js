$(document).ready(function(){
	
	//Top variables
	
	var sum = 0;
	
	var prev_key = "";
	
	//Init
		
	$.get('backend/get_site_text.php?fetch=ajax&key=index', function(data){
			
		$('#content-area').html('<div class="text hidden">'+data+'</div>');
		$('.text').fadeIn('fast');
	});
	
	/* Modal code */

	$('.modal-link').click(function(evt){
		
		evt.preventDefault();
		
		id = $(this).attr('id');
		
		setTimeout(function() {
			$('#'+id+'-modal').modal();
		}, 200);
				
		$('#wrapper').animate({'opacity': '0.2'}, 0);
		
	});
	
	$('.simplemodal-close').click(function(){
		$('#wrapper').animate({'opacity': '1'}, 0);
	});
	
	/* Login modal code */
	
	$('#send-login').live('click', function(evt){
		evt.preventDefault();
		
		var username = $('#login-username').val();
		var password = $('#login-password').val();
		
		$.post('backend/login_user.php',
			{
				username: username,
				password: password
			},
		function(data) {
			if (data == "Success") {
				$('#close-login-modal').click();
				
				$.get('backend/get_user_tabs.php?fetch=ajax', function(data){
					if ($('.top-link').length < 5) {
						$('#login').remove();
						$('#register').remove();
						$('#help').removeClass('shifted-link');
						
						$('#links').append(data);
					};
				});
			}
			else {
				$('#login-error').html(data);
			}
		});
			
	});
	
	$('#send-remember').click(function(evt){
		evt.preventDefault();
		
		$('#login-modal-content').empty();
		
		var closer = '<a href="" id="close-login-modal" class="modal-closer simplemodal-close"> X </a>';
		
		var header = '<h2> Nytt lösenord </h2>';
		
		var email_input = '<div class="modal-input"> <label for="remember-email">Epost</label> <br /> <input type="text" name="remember-email" value="" id="remember-email" /> </div>';
		
		var error = '<div id="login-error"> </div>';
		
		$('#login-modal-content').html(closer+header+email_input+error);
		
		$('#send-remember').remove();
		$('#send-login').attr('id', 'submit-remember');
		
	});
	
	$('#submit-remember').live('click', function(evt){
		evt.preventDefault();
		
		var email = $('#remember-email').val();
		
		$.post('backend/set_new_password.php',
			{
				fetch: 'ajax',
				email: email
			},
			function(data) {
				if (data == "Success") {
					setLabel("#login-error", "Ett nytt lösenord har skickats till den angivna epostadressen.");
					$('#submit-remember').remove();
					
					setTimeout(function() {
						$('#close-login-modal').click();
					}, 10000);
				}
				else {
					$('#login-error').html(data);
				}
			}
		);
		
	});
	
	/* Register modal code */
	
	$('#send-register').live('click', function(evt){
		
		evt.preventDefault();
		
		var username = $('#username').val();
		var password = $('#password').val();
		var confirm_password = $('#confirm-password').val();
		var name = $('#name').val();
		var ssn = $('#ssn').val();
		var email = $('#eaddr').val();
		var phone = $('#phone').val();
		var country = $('#country option:selected').val();
		
		$.post('backend/register_user.php', 
			{
				username: username,
				password: password,
				confirm_password: confirm_password,
				name: name,
				ssn: ssn,
				eaddr: email,
				phone: phone,
				country: country
			},
		function(data) {
			if (data == "Success") {
				$('.simplemodal-close').click();
				
				$.get('backend/logged_in_content.php?r='+data, function(content){
					$('#links').append(content);
				});
			} 
			else {
				$('#register-error').html(data);
			}
		});
		
	});
	
	/* Info-click, on register-modal */
	
	$('#send-info').live('click', function(evt){
		evt.preventDefault();
		
		$('#close-register-modal').click();
				
		$('#info').click();

		window.location = '#content';
	});
	
	/* Get texts, onClick */
	
	$('#index').click(function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		if (key == prev_key) return false;
		
		prev_key = key;
		
		$.get('backend/get_site_text.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="text hidden">'+data+'</div>');
			$('.text').fadeIn('fast');
			
		});
		
	});
	
	$('#help').click(function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		if (key == prev_key) return false;
		
		prev_key = key;
		
		$.get('backend/get_site_text.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="text hidden">'+data+'</div>');
			$('.text').fadeIn('fast');
			
		});
		
	});
	
	$('#info').click(function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		if (key == prev_key) return false;
		
		prev_key = key;
		
		$.get('backend/get_site_text.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="text hidden">'+data+'</div>');
			$('.text').fadeIn('fast');
			
		});
		
	});
	
	$('#ticket').live('click', function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		$.get('backend/get_ticket_data_form.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="form hidden">'+data+'</div>');
			$('.form').fadeIn('fast');
			
			verifyCompleteData();
			
		});
		
	});
	
	$('#activate-editing').live('click', function(){
		
		$('#register-modal').remove();
		
		var chk = $(this).attr('checked');
		
		if (chk) {
			setLabel('#editing-label', 'Spara');
			
			$.each($('.text-edit'), function(i, row){
				$(row).attr('readonly', '');
			});
		}
		else {
			$('#editing-label').html('Redigera');
			
			var n = $('#name').val();
			var s = $('#ssn').val();
			var e = $('#eaddr').val();
			var p = $('#phone').val();
			var c = $('#country').val();
			
			var st = $('#street_address').val();
			var z = $('#zipcode').val();
			var ci = $('#city').val();
			var a = $('#allergies').val();
			
			$.post('backend/set_user_data.php',
				{
					fetch: 'ajax',
					name: n,
					ssn: s,
					email: e,
					phone: p,
					country: c 
				},
				function(user_data) {										
					$.post('backend/set_ticket_data.php',
						{
							fetch: 'ajax',
							street_address: st,
							zipcode: z,
							city: ci,
							allergies: a 
						},
						function(ticket_data) {
															
						if (ticket_data) {
							setLabel('#success-message', 'Data sparades, fuck yeah seakip.');
						}
						else {
							$('#success-message').html(ticket_data);
						}
					});
				});
			
			$.each($('.text-edit'), function(i, row){
				$(row).attr('readonly', 'readonly');
			});
		}
		
	});
	
	$('.cost-object').live('click', function(){
		
		sum = 0;
		
		var id = $(this).attr('id');
		id = parseInt(id.substr(6,1));
		
		$('#status'+id).html('<img src="imgs/loading.gif" alt="loading" />');
		
		var chk = $(this).attr('checked');
		
		if (chk) {
			var val = 1;
		} 
		else {
			var val = 0;
		}
				
		$.post('backend/set_user_object.php', {fetch: 'ajax', id: id, value: val}, function(data){
						
			if (data == "Success") {
				$('#status'+id).html('');
			}
			else {
				$('#status'+id).html(data);
			}
		});

		$.each($('.cost-object'), function(i, row){

			cost = parseInt(row.value);

			if ($(row).attr('checked')) {
				sum = sum + cost;
			}
		});

		$('#total-cost').html(sum);
	});
	
	$('#country').live('click', function(evt){
		
		var con = $('#country option:selected').val();
		
		if (con != "se") {
			$('#ssn').attr('readonly', 'readonly');
			$('#ssn').slideUp('slow');
		}
		else {
			$('#ssn').attr('readonly', '');
			$('#ssn').slideDown('slow');
		}
		
	});
	
});

//Globally used functions

function setLabel(dom_object, text) {
	$.get('backend/__l_ajax.php?string='+text, function(data){
		$(dom_object).html(data);
	})
}

function verifyCompleteData() {
	$.get('backend/verify_user_data.php?fetch=ajax', function(data){
		if (data == "Success") {
			$.get('backend/get_payment_data.php?fetch=ajax', function(payment_data){ $('#ticket-sidebar').html(payment_data); });
		}
	});
}



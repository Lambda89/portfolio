$(document).ready(function(){
	
	// Top variables
	
	var prev_key = "";
	
	var backend_path = '../backend/';
		
	$.get('../backend/get_site_text.php?fetch=ajax&key=index', function(data){
			
		$('#content-area').html('<div class="text hidden">'+data+'</div>');
		$('.text').fadeIn('fast');
			
	});
	
	$('.modal-link').click(function(){
		
		id = $(this).attr('id');
		
		setTimeout(function() {
			$('#'+id+'-modal').modal();
		}, 300);
				
		$('#wrapper').animate({'opacity': '0.2'}, 0);
		
		return false;
	});
	
	$('.simplemodal-close').click(function(){
		$('#wrapper').animate({'opacity': '1'}, 0);
	});
	
	/* Login */
	
	$('#send-login').live('click', function(){
		var adm_usn = $('#admin-username').val();
		var adm_psw = $('#admin-password').val();
		
		$.post('b2-admin-back/admin_login.php?fetch=ajax',
			{
				username: adm_usn,
				password: adm_psw
			},
			function(data){
				if (data == "Success") {
					$('.simplemodal-close').click();
					
					$.get('b2-admin-back/get_admin_tabs.php?fetch=ajax', function(data){
						$('#login').remove();
						$('#help').removeClass('shifted-link');
						
						$('#links').append(data);
					});
				}
				else {
					$('#login-error').html(data);
				}
			}
		)
		
	});
	
	/* Get texts, onClick */
	
	$('#index').click(function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		if (key == prev_key) return false;
		
		prev_key = key;
		
		$.get(backend_path+'get_site_text.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="text hidden">'+data+'</div>');
			$('.text').fadeIn('fast');
			
		});
		
	});
	
	$('#help').click(function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		if (key == prev_key) return false;
		
		prev_key = key;
		
		$.get(backend_path+'get_site_text.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="text hidden">'+data+'</div>');
			$('.text').fadeIn('fast');
			
		});
		
	});
	
	$('#info').click(function(evt){
		
		evt.preventDefault();
		
		var key = $(this).attr('id');
		
		if (key == prev_key) return false;
		
		prev_key = key;
		
		$.get(backend_path+'get_site_text.php?fetch=ajax&key='+key, function(data){
			
			$('#content-area').html('<div class="text hidden">'+data+'</div>');
			$('.text').fadeIn('fast');
			
		});
		
	});
	
});
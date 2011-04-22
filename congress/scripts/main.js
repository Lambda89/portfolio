$(document).ready(function(){
	
	//AJAX-setup
	
	$.ajaxSetup({cache: false});
	
	/* Top variables
	*/
	
	var data = "";
	var text = "";
	
	var tt_label = "";
	var fn_label = "";
	
	/*
	* VALIDATE for the register.php- and purchase.php-views
	* #eaddr.live.keyup
	* #phone.live.keyup
	*/
	
	$('#eaddr').live('keyup', function(){
		var regexp = /^([a-zA-Z0-9-.+_])+@([a-zA-Z0-9-_])+\.([a-zA-Z0-9]{2,5})+$/;
		
		if ($(this).val().match(regexp)) {
			$(this).css({border: '2px solid green'});
		} else {
			$(this).css({border: '2px solid red'});
		}
	});
	
	$('#phone').live('keyup', function(){
		var regexp = /^([0-9-]{5,24})+$/;
		
		if ($(this).val().match(regexp)) {
			$(this).css({border: '2px solid green'});
		} else {
			$(this).css({border: '2px solid red'});
		}
	});
	
	/*
	* AJAX for the purchase.php-view
	* #number.click: Fetches a number of forms, for saving as tickets.
	* #submit_purchase.click: Validates form fields, and if all of them are correct, sends the form.
	*/

	$('#number').click(function(){		
		
		//Get number of...
		var tickets = $('#number option:selected').val();
		
		//Remove earlier tickets, if another number is chosen
		
		$('.ticket').remove();
		
		$.get('dispatchers/generate_tickets.php?number_of='+tickets, function(data){
			$('#tickets').html(data);
		});
		
	});
	
	$('#submit_purchase').click(function(evt){
		
		evt.preventDefault();
		var correct = true;
		
		//Count number of tickets
		
		var purchased_tickets = $('.ticket').length;
		
		for (var i=0; i < purchased_tickets; i++) {
			
			//Create variables to ...
			var tt = $('#ticket-type'+i).val();
			var fn = $('#first-name'+i).val();
			var ln = $('#last-name'+i).val();
			var ea = $('#eaddr'+i).val();
			var ph = $('#phone'+i).val();
			var ad = $('#address'+i).val();
			var pc = $('#postal-code'+i).val();
			var lc = $('#location'+i).val();
			var ui = $('#user_id').val();
			
			//...be validated
			
			if (fn == "") {
				$('#first-name'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#first-name'+i).css({border: '2px solid green'});
			}
			
			if (ln == "") {
				$('#last-name'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#last-name'+i).css({border: '2px solid green'});
			}
			
			if (!ea.match(/[a-zA-Z0-9+._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9]{2,5}/)) {
				$('#eaddr'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#eaddr'+i).css({border: '2px solid green'});
			}
			
			if (!ph.match(/[0-9-]{6,25}/)) {
				$('#phone'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#phone'+i).css({border: '2px solid green'});
			}
			
			if (ad == "") {
				$('#address'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#address'+i).css({border: '2px solid green'});
			}
			
			if (pc == "") {
				$('#postal-code'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#postal-code'+i).css({border: '2px solid green'});
			}
			
			if (lc == "") {
				$('#location'+i).css({border: '2px dashed red'});
				correct = false;
			} else {
				$('#location'+i).css({border: '2px solid green'});
			}
			
			if (correct != false) {
				//If everything checks out nicely; send with postrequest to insert_ticket.php
				$.post('dispatchers/insert_ticket.php', {ticket_type: tt, first_name: fn, last_name: ln, eaddr: ea, phone: ph, address: ad, postal_code: pc, location: lc, user_id: ui}, function(data){
					$('#ticket'+i).html(data);
				});
			}
			
		};
		
		if (correct != false) {
			setTimeout(function() {
				window.location = "display.php";
			}, 7000);
		} else {
			return false;
		}
				
	});

	/*
	* AJAX and Controls for display.php-view
	*
	*/
	
	$('.edit-ticket').live('click', function(){
		var id = parseInt($(this).attr('id'));
		
		var tt = $('#ticket-type-field'+id).text();
		var fn = $('#first-name-field'+id).text();
		var ln = $('#last-name-field'+id).text();
		var em = $('#email-field'+id).text();
		var ph  = $('#phone-field'+id).text();
		var ad = $('#address-field'+id).text();
		var pc  = $('#postal-code-field'+id).text();
		var lc  = $('#location-field'+id).text();
		
		var elements = ["fn", "ln", "em", "ph", "ad", "pc", "lc"];
		var values = [fn, ln, em, ph, ad, pc, lc];
		
		$('#ticket'+id).empty();
		
		$.getJSON('dispatchers/get_ticket_types.php', function(data) {
			var options = "";
						
			$.each(data, function(i, row){
				options += '<option value="'+row['id']+'">'+row['title']+', '+row['number_of_days']+'</option>'
			});
			
			$('#ticket'+id).prepend('<select id="ticket-types-'+id+'" name="'+id+'-ticket-types">'+options+'</select>')
		});
		
		for (var i=0; i < elements.length; i++) {
			$('#ticket'+id).append('<input type="text" id="'+elements[i]+'-input-'+id+'" value="'+values[i]+'" />');
		};
		
		$('#ticket'+id).append('<input type="submit" class="submit-edit submit-button" id="submit-edit-'+id+'" name="'+id+'-edit-submit" />')
		
		return false;
	});
	
	$('.submit-edit').live('click', function(){
		var id = parseInt($(this).attr('name'));
		
		var tt = $('#ticket-types-'+id+' option:selected').val();
		var fn = $('#fn-input-'+id).val();
		var ln = $('#ln-input-'+id).val();
		var em = $('#em-input-'+id).val();
		var ph = $('#ph-input-'+id).val();
		var ad = $('#ad-input-'+id).val();
		var pc = $('#pc-input-'+id).val();
		var lc = $('#lc-input-'+id).val();
		var user_id = parseInt($('#user-id').text());
		
		$.post('dispatchers/update_ticket.php', {id: id, ticket_type: tt, first_name: fn, last_name: ln, eaddr: em, phone: ph, address: ad, postal_code: pc, location: lc, user_id: user_id});
		
		setTimeout(function() {
			redrawTickets();
		}, 1000);
		
		return false;
	});
	
	$('.delete-ticket').live('click', function(){
		var id = parseInt($(this).attr('id'));
				
		var user_id = parseInt($('#user-id').text());
		
		$.post('dispatchers/delete_ticket.php', {id: id, user_id: user_id});
		
		setTimeout(function() {
			redrawTickets();
		}, 1000);
		
		return false;
	});
	
	$('#delete-account-user').live('click', function(){
		
		var id = parseInt($(this).attr('href'));
				
		$('#modal').modal();
		
		$('#yes-delete').attr('name', id+'confirm-delete')
		
		return false;
	});
	
	$('#yes-delete').live('click', function(){
		var id = parseInt($(this).attr('name'));
		
		$('.simplemodal-close').click();
		
		$.post('dispatchers/delete_user.php', {user_id: id});
		
		setTimeout(function() { window.location = "index.php" }, 1000);
				
		return false;
	});
	
	function redrawTickets () {
		$('#tickets').empty();
		
		$.get('dispatchers/get_tickets.php?relative=true', function(data){
			$('#tickets').html(data);
		});
	}
	
	/*
	* Controls for terms.php
	*
	*/

	if ($('#signature').length > 0) {
		id = parseInt($('#user-id').text());
		
		$.getJSON('dispatchers/get_user.php?id='+id, function(data){
			$('#signature').html(data[0]['first_name']+' '+data[0]['last_name']);
		});
	};
	
});
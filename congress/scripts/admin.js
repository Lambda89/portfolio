$(document).ready(function(){
	
	//Top variables
	
	var bulk_ids = [];
	
	//AJAX-setup
	
	$.ajaxSetup({cache: false});
	
	//Top variables
	
	/*
	* AJAX for admin/ticket_types.php-view
	*  
	*
	*/
	
	if ($('#ticket-types-area').length > 0) {
		
		drawTypesTable();
		
		function drawTypesTable () {
			$('.type-data-rows').remove();

			$.getJSON('../dispatchers/get_ticket_types.php', function(data){
				$.each(data, function(i, row){
					$('#ticket-types-list').append('<tr class="type-data-rows" id="type'+row['id']+'"> <td id="title'+row['id']+'">'+row['title']+'</td> <td id="days'+row['id']+'">'+row['number_of_days']+'</td> <td id="cost'+row['id']+'">'+row['cost']+'</td> <td> <a href="?" class="edit" id="'+row['id']+'edit"> E </a> </td> <td> <a href="?" class="delete" id="'+row['id']+'delete"> X </a> </td> </tr>');
				});
			});
		}
		

	};
	
	$('#create-ticket-type').live('click', function(){
		
		var title = $('#new-title').val();
		var cost = $('#new-cost').val();
		var days = $('#new-number-of-days').val();
	
		$.post('../dispatchers/create_ticket_type.php', {title: title, cost: cost, number_of_days: days});
		
		setTimeout(function() {
			drawTypesTable();
		}, 500);
		
		return false;
	});
	
	$('.edit').live('click', function(){
		var id = parseInt($(this).attr('id'));
		
		var title = $('#title'+id).text();
		var cost = $('#cost'+id).text();
		var days = $('#days'+id).text();
		
		$('#title'+id).html('<input type="text" id="input_title'+id+'" value="'+title+'">').parent().addClass('active');
		$('#cost'+id).html('<input type="text" id="input_cost'+id+'" value="'+cost+'">');
		$('#days'+id).html('<input type="text" id="input_days'+id+'" value="'+days+'">').parent().append('<td> <a href="?" class="save" id="'+id+'save"> S </a> </td>');
		
		return false;
	});
	
	$('.delete').live('click', function(){
		var id = parseInt($(this).attr('id'));
		
		$.post('../dispatchers/delete_ticket_type.php', {id: id});
		
		setTimeout(function() {
			drawTypesTable();
		}, 500);
		
		return false;
	});
	
	$('.save').live('click', function(){
		
		var id = parseInt($(this).attr('id'));
		
		var title = $('#input_title'+id).val();
		var cost = $('#input_cost'+id).val();
		var days = $('#input_days'+id).val();
		
		$.post('../dispatchers/update_ticket_type.php', {id: id, title: title, cost: cost, number_of_days: days});
		
		setTimeout(function() {
			drawTypesTable();
		}, 500);
		
		return false;
	});
	
	/*
	* Visuals/AJAX for admin/venues.php
	*
	*/
	
	if ($('#venues-area').length > 0) {
		
		drawVenuesTable();
		
		function drawVenuesTable () {
			$('.type-data-rows').remove();

			$.getJSON('../dispatchers/get_venues.php', function(data){
				$.each(data, function(i, row){
					$('#venues-list').append('<tr class="type-data-rows" id="type'+row['id']+'"> <td id="title'+row['id']+'">'+row['title']+'</td> <td id="cost'+row['id']+'">'+row['cost']+'</td> <td id="venue-type'+row['id']+'">'+row['venue_type']+'</td> <td> <a href="?" class="edit-venue" id="'+row['id']+'edit"> E </a> </td> </tr>');
				});
			});
		}

	};
	
	$('#create-venue').live('click', function(){
		
		var title = $('#new-title').val();
		var cost = $('#cost').val();
		var type = $('#venue-type').val();
	
		$.post('../dispatchers/create_venue.php', {title: title, cost: cost, venue_type: type});
		
		setTimeout(function() {
			drawVenuesTable();
		}, 500);
		
		return false;
	});
	
	$('.edit-venue').live('click', function(e){
		e.preventDefault();
		
		var id = parseInt($(this).attr('id'));
		
		var title = $('#title'+id).text();
		var cost = $('#cost'+id).text();
		var type = $('#venue-type'+id).text();
		
		$('#title'+id).html('<input type="text" id="input-title'+id+'" value="'+title+'" />');
		$('#cost'+id).html('<input type="text" id="input-cost'+id+'" value="'+cost+'" />');
		$('#venue-type'+id).html('<input type="text" id="input-type'+id+'" value="'+type+'" />').parent().append('<td> <a href="?" class="save-venue" id="'+id+'save"> S </a> </td>').addClass('active');
		
	});
	
	$('.save-venue').live('click', function(){
		
		var id = parseInt($(this).attr('id'));
		
		var title = $('#input-title'+id).val();
		var cost = $('#input-cost'+id).val();
		var venue_type = $('#input-type'+id).val();
		
		$.post('../dispatchers/update_venue.php', {id: id, title: title, cost: cost, venue_type: venue_type});
		
		setTimeout(function() {
			drawVenuesTable();
		}, 500);
		
		return false;
	});
	
	/*
	* Visuals/AJAX for admin/index.php
	*
	*/
	
	$('.show-data').live('click', function(){
		var id = parseInt($(this).attr('name'));
		
		$('#hidden-data'+id).toggle();
				
		return false;
	});
	
	$('.bulk-action').live('click', function(){
			
			
			setTimeout(function() {
				//Reset bulk ids
				
				var bulk_ids = [];

				var length = $('.bulk-action').length;

				for (var i=0; i < length; i++) {

					var checked = $('#bulk-action'+i).attr('checked');

					if (checked == true) {
						bulk_ids.push($('#bulk-action'+i).val());
					};

				};

				if (bulk_ids.length == 0) {
					$('#bulk-action-area').empty();
					
					checked = $('#check-all-mail').attr('checked');
					
					if (checked == true) {
						$('#check-all-mail').attr('checked', false);
					};
				} else {

					var emails = [];
					var hidden_inputs = "";

					for (var i=0; i < bulk_ids.length; i++) {
						var email = $('#email-address'+bulk_ids[i]).attr('name');
						hidden_inputs += '<input type="hidden" class="bulk-emails '+i+'bulk-id" id="hidden-bulk-id'+bulk_ids[i]+'" value="'+email+'" />';

						emails.push(email);
					};

					var emails_string = "";

					for (var i=0; i < emails.length; i++) {
						emails_string += emails[i]+"; ";
					};

					var email_form = '<div class="mailer-area">Mottagare<br /><input type="text" class="bulk-mail-input" readonly="readonly" value="'+emails_string+'" /><br />Ämne<br /><input type="text" id="bulk-mailer-topic" value="" /><br />Meddelande<br /><textarea rows="4" id="bulk-mailer-message"> </textarea> <br /> <a href="?" id="send-bulk-mail"> Skicka </a></div>';

					var topic = $('#bulk-mailer-topic').val();
					var message = $('#bulk-mailer-message').val();

					$('#bulk-action-area').html(email_form+hidden_inputs);
					
					$('#bulk-mailer-topic').val(topic);
					$('#bulk-mailer-message').val(message);					
					
					var wideness = 119*bulk_ids.length+'px';
					
					if ($('.bulk-mail-input').css('width') < '500') {
						$('.bulk-mail-input').css({'width': wideness});
					};
					
				}
			}, 100);
		
	});
	
	$('#send-bulk-mail').live('click', function(){
		
		emails = [];
		var topic = $('#bulk-mailer-topic').val();
		var message = $('#bulk-mailer-message').val();
		
		for (var i=0; i < $('.bulk-emails').length; i++) {
			emails.push($('.'+i+'bulk-id').val());
		};
		
		for (var i=0; i < emails.length; i++) {
			$.post('../dispatchers/send_user_email.php', {eaddr: emails[i], topic: topic, message: message});
		};
		
		$('#bulk-action-area').empty();
		
		return false;
	});
	
	$('#check-all-mail').live('click', function(){
		$('.mailto').empty().hide();
		
		var checkboxes = $('.bulk-action').length;

		for (var i=0; i < checkboxes; i++) {
			$('#bulk-action'+i).click();
		};		
	});
	
	$('.delete-user-link').live('click', function(){
		
		var id = parseInt($(this).attr('name'));
				
		$('#modal').modal();
		
		$('#yes-delete').attr('name', id+'confirm-delete')
		
		return false;
	});
	
	$('#yes-delete').live('click', function(){
		var id = parseInt($(this).attr('name'));
		
		$('.simplemodal-close').click();
		
		$.post('../dispatchers/delete_user.php', {user_id: id});
		
		drawUsers();
		
		return false;
	});
	
	function drawUsers () {
		setTimeout(function() {
			$.get('../dispatchers/get_users.php?relative=true', function(data){
				$('#users-division').html(data);
			});
		}, 500);
	}
	
	/*
	* AJAX for admin/tickets.php
	*/
	
	$('.edit-ticket-admin').live('click', function(){
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
		
		$.getJSON('../dispatchers/get_ticket_types.php', function(data) {
			var options = "";
						
			$.each(data, function(i, row){
				options += '<option value="'+row['id']+'">'+row['title']+', '+row['number_of_days']+'</option>'
			});
			
			$('#ticket'+id).prepend('<select id="ticket-types-'+id+'" name="'+id+'-ticket-types">'+options+'</select>')
		});
		
		for (var i=0; i < elements.length; i++) {
			$('#ticket'+id).append('<input type="text" id="'+elements[i]+'-input-'+id+'" value="'+values[i]+'" />');
		};
		
		$('#ticket'+id).append('<input type="submit" class="submit-edit-admin submit-button" id="submit-edit-'+id+'" name="'+id+'-edit-submit" />')
		
		return false;
	});
	
	$('.submit-edit-admin').live('click', function(){
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
		
		$.post('../dispatchers/update_ticket.php', {id: id, ticket_type: tt, first_name: fn, last_name: ln, eaddr: em, phone: ph, address: ad, postal_code: pc, location: lc, user_id: user_id});
		
		setTimeout(function() {
			redrawTicketsAdmin();
		}, 1000);
		
		return false;
	});
	
	$('.delete-ticket-admin').live('click', function(){
		var id = parseInt($(this).attr('id'));
				
		$('#modal-ticket').modal();
		
		$('#yes-delete-ticket').attr('name', id+'confirm-delete')

		return false;
	});
	
	$('#yes-delete-ticket').live('click', function(){
		var id = parseInt($(this).attr('name'));
				
		var user_id = parseInt($('#user-id').text());
		
		$('.simplemodal-close').click();
		
		$.post('../dispatchers/delete_ticket.php', {id: id, user_id: user_id});
		
		setTimeout(function() {
			redrawTicketsAdmin();
		}, 1000);
		
		return false;
	});
	
	$('.approve-payment-admin').live('click', function(){
		var id = parseInt($(this).attr('id'));
		
		var user_id = parseInt($('#user-id').text());
		
		$.post('../dispatchers/approve_payment.php', {id: id, user_id: user_id});
		
		setTimeout(function() {
			redrawTicketsAdmin();
		}, 1000);
		
		return false;
	});
	
	function redrawTicketsAdmin () {
		var id = parseInt($('#user-id').text());
		
		$('#tickets').empty();
		
		$.get('../dispatchers/get_tickets_admin.php?relative=true&id='+id, function(data){
			$('#tickets').html(data);
		});
	}
	
	/*
	* AJAX for admin/statistics.php
	*
	*/
	
	if ($('#statistics').length > 0) {
		setTimeout(function() {
			drawStatistics();
		}, 60000);
	};
	
	function drawStatistics () {
		$('#statistics').empty();
		
		$.get('../dispatchers/format_users_data.php?relative=true', function(data){
			$('#statistics').html(data);
		});
		
		setTimeout(function() {
			drawStatistics();
		}, 60000);
	}
	
	/*
	* AJAX for admin/end_date.php
	*
	*/
	
	$('#submit-new-date').live('click', function(){
		
		var date = $('#new-date').val();
		
		$.post('../dispatchers/update_end_date.php', {date: date});
		
		setTimeout(function() {
			$('#end-date').empty();
			
			$.get('../dispatchers/end_date_form.php?relative=true', function(data){
				$('#end-date').html(data);
			})
		}, 1000);
		
		return false;
	});
	
	
	
	
	
	
});
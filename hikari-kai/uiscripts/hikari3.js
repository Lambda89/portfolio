$(document).ready(function(){
	
		$(".main").hide();
		$(".society").hide();
		
		//Check month
		// December = Red (Christmas time!)

		time = new Date();
		month = time.getMonth();

		if (month == 11) {
			color = '#DD0000';
		} else if (month >= 0 && month < 7) {
			color = '#FF8888';
		} else if (month > 6 && month < 11) {
			color = '#FFAA44';
		}
			//Randomization-code is kept for future reference/modification

			/*var colorId = Math.floor(Math.random()*3);

			color = bodycolors[colorId]; */

		$("body").css({'background-color': color});
		
		//On hover, show submenus
		
		$(".menu").hover(function(){
			$(this).find(".toplink").addClass('active_link');
			var id = $(this).find(".toplink").attr('id');
				
			$("."+id).show();
		}, function(){
			$(this).find(".toplink").removeClass('active_link');
			var id = $(this).find("li").attr('id');
			
			$("."+id).hide();
		});
		
		//Admin-related scripts
		//Hides and shows forms depending on actions. Uses jQuery-animations.
		
		$('#new_post').hide();
		$('#new_event').hide();
		$('#new_document').hide();
		$('#new_contact').hide();
		$('#suggestion_form').hide();
		$('#comment_form').hide();
		
		$('#post').click(function(){
			id = $(this).attr('id');
			$('.active').hide(400).removeClass('active');
			$('#new_'+id).show(600).addClass('active');
		});
		
		$('#event').click(function(){
			id = $(this).attr('id');
			$('.active').hide(400).removeClass('active');
			$('#new_'+id).show(600).addClass('active');
		});
		
		$('#document').click(function(){
			id = $(this).attr('id');
			$('.active').hide(400).removeClass('active');
			$('#new_'+id).show(600).addClass('active');
		});
		
		$('#contact').click(function(){
			id = $(this).attr('id');
			$('.active').hide(400).removeClass('active');
			$('#new_'+id).show(600).addClass('active');
		});
		
		$('#suggestion').click(function(){
			$('#suggestion_form').show(600).addClass('active');
			return false;
		});
		
		$('#comment_link').click(function(){
			$('#comment_form').show(600).addClass('active');
			return false;
		});
		
		$('.close').click(function(){
			$('.active').hide(400).removeClass('active');
			return false;
		});
		
		
		
		$('.delete').click(function(){
			var del = confirm("Är du säker på att du vill radera?");
			
			if (del) {
				return true;
			} else {
				return false;
			}
		});
		
});

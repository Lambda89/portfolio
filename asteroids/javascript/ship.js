$(document).ready(function(){

	/*
		File: ship.js
		Desc:
			All scripts related to movement of the ship.
			Moving forward, moving left/right and checking position, shooting.
		Dependencies: jquery.js (jQuery 1.4.2)
		Author: Rickard Lund
		Date: 2011-06-12
	*/

	// User agent transformation variable
	var agent = $.browser;
	if (agent.webkit) {
		var transformation_html = '-webkit-transform';
		$('#ship').css({'webkitTransform': 'rotate(0deg)'});
	}
	else if (agent.mozilla) {
		var transformation_html = '-moz-transform';
		$('#ship').css({'-moz-transform': 'rotate(0deg)'});
	}

	// General purpose timeout variable

	var t;

	// Possible directions. Should be some sort of dynamic
	// algorithm if developed further in the future.
	// Works perfectly fine ... for now. :)

	var possible_directions = [];
	possible_directions[0] = [-15, 0];
	possible_directions[15] = [-14.25, 3.25];
	possible_directions[30] = [-13.5, 7.5];
	possible_directions[45] = [-10.5, 10.5];
	possible_directions[60] = [-7.5, 13.5];
	possible_directions[75] = [-3.25, 14.25];
	possible_directions[90] = [0, 15];
	possible_directions[105] = [3.25, 14.25];
	possible_directions[120] = [7.5, 13.5];
	possible_directions[135] = [10.5, 10.5];
	possible_directions[150] = [13.5, 7.5];
	possible_directions[165] = [14.25, 3.25];
	possible_directions[180] = [15, 0];
	possible_directions[195] = [14.25, -3.25];
	possible_directions[210] = [13.5, -7.5];
	possible_directions[225] = [10.5, -10.5];
	possible_directions[240] = [7.5, -13.5];
	possible_directions[255] = [3.25, -14.25];
	possible_directions[270] = [0, -15];
	possible_directions[285] = [-3.25, -14.25];
	possible_directions[300] = [-7.5, -13.5];
	possible_directions[315] = [-10.5, -10.5];
	possible_directions[330] = [-13.5, -7.5];
	possible_directions[345] = [-14.25, -3.25];

	// Check for keydown/keyup-events to control ship
	// jQuery normalizes keypresses (in theory, at least)

	$('html').bind('keyup', function(evt){
		if (evt.keyCode == 38) {
			move_forward();
		}
	});
	$('html').bind('keydown', function(evt){
		if (evt.keyCode == 37) {
			move_left();
		}
		if (evt.keyCode == 39) {
			move_right();
		}
		if (evt.keyCode == 40) {
			gravity_stop();
		}
	});
	$('html').bind('keyup', function(evt){
		if (evt.keyCode == 32) {
			pew_pew_pew();
		}
	});
	$('html').bind('keyup', function(evt){
		if (evt.keyCode == 66) {
			theres_only_two_ways_this_can_end();
		}
	});

	function check_position () {
		var ship = $('#ship');
		var top = parseInt($(ship).css('top'));
		var left = parseInt($(ship).css('left'));

		if (agent.webkit) {
			var deg = $(ship).css(transformation_html);
		}
		if (agent.mozilla) {
			var deg = $(ship).attr('style');
		}
		deg = parseInt(deg.replace(/[\D]{1,200}/, ''));

		if ((top < -10 || top > 510) || (left < -10 || left > 710)) {
			return_to_space(top, left);
		}
	}

	// Function that moves ship forward
	// Gets position and rotation, and uses static array to calculate
	// the amount of movement per direction

	function move_forward () {
		var ship = $('#ship');
		$(ship).stop();
		clearTimeout(t);

		if (t) {
			gravity_stop();
		}

		if (agent.webkit) {
			var deg = $(ship).css(transformation_html);
		}
		if (agent.mozilla) {
			var deg = $(ship).attr('style');
		}
		deg = parseInt(deg.replace(/[\D]{1,200}/, ''));
		
		var curr_top = parseInt($('#ship').css('top'));
		var curr_left = parseInt($('#ship').css('left'));

		var new_top = possible_directions[deg][0]*10;
		var new_left = possible_directions[deg][1]*10;

		var top = curr_top + new_top;
		var left = curr_left + new_left;

		$(ship).css({'border-bottom': '5px solid #ff0'});
		setTimeout(function() { $(ship).css({'border-bottom': '5px solid #f00'}); }, 200);
		$(ship).animate({'top': top + 'px', 'left': left + 'px'}, 1000, 'linear', function(){
			keep_acceleration(ship, deg);
		});
	}

	// Function that creates the "momentum" of the ship
	// Recursively pushes the ship to next x,y-coordinates as specified
	// by the firing of the engine

	function keep_acceleration (ship, deg) {
		clearTimeout(t);

		check_position();

		var curr_top = parseInt($('#ship').css('top'));
		var curr_left = parseInt($('#ship').css('left'));

		var new_top = possible_directions[deg][0]*10;
		var new_left = possible_directions[deg][1]*10;

		var top = curr_top + new_top;
		var left = curr_left + new_left;

		$(ship).animate({'top': top+'px', 'left': left+'px'}, 1000, 'linear', function(){
			keep_acceleration(ship, deg);	
		});
	}

	// Function that rotates ship 15 degrees to the left
	// Fallback to 345 if surpasses full circle

	function move_left () {
		var ship = $('#ship');
		if (agent.webkit) {
			var deg = $(ship).css(transformation_html);
			deg = parseInt(deg.replace(/[\D]{1,200}/, ''));
			deg = deg - 15;
			if (deg < 0) {
				deg = 345;
			}
			$(ship).css({'webkitTransform': 'rotate('+deg+'deg)'});
		}
		if (agent.mozilla) {
			var deg = $(ship).attr('style');
			deg = parseInt(deg.replace(/[\D]{1,200}/, ''));
			deg = deg - 15;
			if (deg < 0) {
				deg = 345;
			}
			$(ship).css({'-moz-transform': 'rotate('+deg+'deg)'});
		}
	}

	// Function that rotates ship 15 degrees to the right
	// Fallback to 0 if surpasses full circle

	function move_right () {
		var ship = $('#ship');
		if (agent.webkit) {
			var deg = $(ship).css(transformation_html);
			deg = parseInt(deg.replace(/[\D]{1,200}/, ''));
			deg = deg + 15;
			if (deg > 350) {
				deg = 0;
			};
			$(ship).css({'webkitTransform': 'rotate('+deg+'deg)'});
		}
		if (agent.mozilla) {
			var deg = $(ship).attr('style');
			deg = parseInt(deg.replace(/[\D]{1,200}/, ''));
			deg = deg + 15;
			if (deg > 350) {
				deg = 0;
			}
			$(ship).css({'-moz-transform': 'rotate('+deg+'deg)'});
		}
	}

	// Stops momentum-timeout

	function gravity_stop () {
		$('#ship').stop();
		clearTimeout(t);
	}

	// Function that checks if player has left visible space,
	// returns user to other side if so.

	function return_to_space (top, left) {
		var ship = $('#ship');
		if (top < -20 && left < -20) {
			$(ship).animate({'top': '500px', 'left': '700px'}, 0);
		}
		if (top < -20 && left > 0) {
			$(ship).animate({'top': '500px', 'left': left + 'px'}, 0);
		}
		if (top > 0 && left < -20) {
			$(ship).animate({'top': top + 'px', 'left': '700px'}, 0);
		}
		if (top > 520 && left > 720) {
			$(ship).animate({'top': '0px', 'left': '0px'}, 0);
		}
		if (top > 520 && left < 720) {
			$(ship).animate({'top': '0px', 'left': left + 'px'}, 0);
		}
		if (top < 520 && left > 720) {
			$(ship).animate({'top': top + 'px', 'left': '0px'}, 0);
		};
	}

	// Function to fire laser
	// Uses same static position-values as move_forward() to
	// animate the shot.

	function pew_pew_pew () {
		var ship = $('#ship');
		if (agent.webkit) {
			var deg = $(ship).css(transformation_html);
		}
		if (agent.mozilla) {
			var deg = $(ship).attr('style');
		}
		deg = parseInt(deg.replace(/[\D]{1,200}/, ''));
		if ($('.current_shot').length > 0) { return false; }
		
		var curr_top = $(ship).position().top;
		var curr_left = $(ship).position().left;

		$('#space').append('<div class="laser current_shot" style="position: absolute; top: '+curr_top+'px; left: '+curr_left+'px;"></div>');
		var current_shot = $('.current_shot');

		pos_dir_top = possible_directions[deg][0];
		pos_dir_left = possible_directions[deg][1];

		pos_dir_top = pos_dir_top.toString();
		pos_dir_left = pos_dir_left.toString();

		if (pos_dir_top < 0) {
			pos_dir_top = pos_dir_top.replace(/[\-]/, '');
			topshot = '-=' + pos_dir_top*30 + 'px';
		}
		else {
			topshot = '+=' + pos_dir_top*30 + 'px';
		}
		if (pos_dir_left < 0) {
			pos_dir_left = pos_dir_left.replace(/[\-]/, '');
			leftshot = '-=' + pos_dir_left*30 + 'px'; 
		}
		else {
			leftshot = '+=' + pos_dir_left*30 + 'px'; 
		}
		$(current_shot).animate({'top': topshot, 'left': leftshot}, 1000, function(){
			$(this).remove();
		});
	}

	// Nuke	

	function theres_only_two_ways_this_can_end () {
		$('#space').css({'background-color': '#dd0'});
		$('.asteroid').remove();
		setTimeout(function() { $('#space').css({'background-color': '#191919'}); }, 300);
	}
	

});
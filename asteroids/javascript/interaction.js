$(document).ready(function(){

	/*
		File: interactions.js
		Desc:
			All scripts calculating if objects are colliding.
			Works (mostly) in real-time, checking collisions at millisecond intervals.
		Dependencies: jquery.js (jQuery 1.4.2)
		Author: Rickard Lund
		Date: 2011-06-12
	*/

	setTimeout(function() {
		check_for_collisions();
	}, 1000);
	setTimeout(function() {
		check_for_hits();
	}, 1000);

	// Function that checks for ship->asteroid-collisions
	// Finds positions, and uses these combined with object-widths
	// to calculate collison or not.
	// NOTE: A bit performance-heavy. Not much, but could probably be optimized further
	// with a more advanced algorithm.

	function check_for_collisions () {
		var ship = $('#ship');
		if ($(ship).length < 1 ) { return false; };
		var asteroids = $('.asteroid');

		$.each(asteroids, function(i, ast){
			var ship_position = $(ship).position();
			var ast_position = $(ast).position();
			var y = ast_position.top - ship_position.top;
			var x = ast_position.left - ship_position.left;
			var w = 30 + 10;
			y = y * y;
			x = x * x;
			w = w * w;
			if (y + x < w) {
				setTimeout(function() {
					$(ship).remove();
					$(asteroids).remove();
					$('#space').html('<div class="game_text">GAME OVER</div><br /><a href="index.html">Play again?</a>');
				}, 200);
			}
		});
		setTimeout(function() { check_for_collisions(); }, 3);
	}

	// Function that checks for shot->asteroid-collisions
	// Same as above, but checked at shorter intervals due to higher
	// speed of shot in comparison to ship/asteroids.

	function check_for_hits () {
		var sh = $('#ship');
		var shot = $('.current_shot');
		var asteroids = $('.asteroid');
		
		var shot_position = shot.position();

		if (shot_position) {
			if (shot_position.top < 0 || shot_position.left < 0) {
				setTimeout(function() { check_for_hits(); }, 1);
				return false;
			}
			$.each(asteroids, function(i, ast){
				var ast_position = $(ast).position();
				var y = shot_position.top - ast_position.top;
				var x = shot_position.left - ast_position.left;
				var w = 30 + 10;
				y = y * y;
				x = x * x;
				w = w * w;
				if (y + x < w) {
					if ($(ast).hasClass('hit_once')) {
						$(ast).remove();
						$(shot).remove();
						var score = parseInt($('#score').html());
						score = score + 300;
						$('#score').html(score);
					}
					else if ($(ast).hasClass('small')) {
						$(ast).remove();
						$(shot).remove();
						var score = parseInt($('#score').html());
						score = score + 100;
						$('#score').html(score);
					}
					if ($(ast).hasClass('large')) {
						$(shot).remove();
						$(ast).addClass('hit_once')
					}
				}
			});
		}
		setTimeout(function() { check_for_hits(); }, 10);
	}

	
});
$(document).ready(function(){

	/*
		File: asteroids.js
		Desc:
			All scripts that handle the asteroids themselves.
			Spawning, animations and positioning, but not removal.
			Removal through force is handled by collisions.js (and in
			some part, ship.js).
		Dependencies: jquery.js (jQuery 1.4.2)
		Author: Rickard Lund
		Date: 2011-06-12
	*/

	var ac = 0;

	setTimeout(function() {
		spawn_asteroid();
	}, 500);

	// Function to spawn asteroids
	// Increments id-counter, randomly selects small or big asteroid, places
	// it on the edge of "space"

	function spawn_asteroid () {
		ac++;
		var xy = asteroid_positioning();

		var sizes = ['small', 'small', 'small', 'small', 'large'];
		var size = sizes[Math.floor(Math.random()*5)];

		$('#space').append(
			'<div class="'+size+' asteroid" id="asteroid'+ac+'" style="top:'+xy[0]+'px;left:'+xy[1]+'px;"></div>'
		);
		var speed = 30000;

		setTimeout(function() {
			spawn_asteroid();
		}, 1700);

		curr_ast = $('#asteroid'+ac);
		$(curr_ast).animate({'top': xy[2], 'left': xy[3]}, speed, function(){
			$(this).addClass('comet_and_gone');
		});
	}

	function asteroid_positioning () {
		var spawn_points = [[-30, -30], [530, -30], [-30, 730], [530, 730]];

		var spawn_randomizer = Math.floor(Math.random()*4);

		var spawn = spawn_points[spawn_randomizer];
		
		if (spawn_randomizer == 0) {
			var end = spawn_points[3]; 
		}
		if (spawn_randomizer == 1) {
			var end = spawn_points[2];
		}
		if (spawn_randomizer == 2) {
			var end = spawn_points[1];
		}
		if (spawn_randomizer == 3) {
			var end = spawn_points[0];
		}
		return [spawn[0], spawn[1], end[0], end[1]];
	}
});
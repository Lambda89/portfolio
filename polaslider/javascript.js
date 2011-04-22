//Spin divs

$(document).ready(function(){
	// Get card-elements, then
	// set z-index to place them behind eachother
	var cards = $('.card');
	$.each(cards, function(i, card){
		$(card).css({'z-index': -i});
	});
	$('.card:last').addClass('bottom');
	
	// vars to be used
	var i = 1;
	var duration = 1000;
	
	animateDivs(i, duration);
	
	function animateDivs(i, duration) {
		if (i > 3) { i = 1; } 		
		$('#c'+i).animate({'left': '-=400px', 'top': '+=80px'}, duration, function(){
			var z_ind = $('.bottom').css('z-index');
			z_ind = parseInt(z_ind)-1;
			$('#c'+i).css({'z-index': z_ind});
			$('#c'+i).animate({'left': '+=400px', 'top': '-=80px'}, duration);
			$('.bottom').removeClass('bottom');
			$('#c'+i).addClass('bottom');
			i = i + 1;
			t = setTimeout(function() { animateDivs(i, duration); }, 3000);
		});
	}
});
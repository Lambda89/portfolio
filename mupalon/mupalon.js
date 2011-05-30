$(document).ready(function(){
	$('#music_list').sortable({
		stop: function() {
			$('.last').removeClass('last');
			$('.listed_song:last').addClass('last');
		}
	});
	$('.listed_song:last').addClass('last');

	$.get('http://api.twitter.com/1/statuses/user_timeline.json?screen_name=rickardlund', function(data){
		console.log(data);
	});

	$('.listed_song').live('dblclick', function(){
		var next_song = $(this).attr('id');
		var next_song_text = $(this).text();
		$(this).remove();
	
		var old_song = $('#player').attr('src');
		old_song = old_song.replace('files/', '');
		var old_song_text = $('#current_song').text();

		$('#player').attr('src', 'files/' + next_song);
		$('#current_song').html(next_song_text);
		$('#music_list').append('<li class="listed_song" id="' + old_song + '">'
								+ old_song_text + '</li>');	
	});
	
	$('#next').click(function(){
		// Next song is first in list
		var next_song = $('#music_list li:first').attr('id');
		var next_song_text = $('#music_list li:first').text();

		$('#music_list li:first').remove();

		// Old song is to be put last in list, remove folder from filename
		var old_song = $('#player').attr('src');
		old_song = old_song.replace('files/', '');
		var old_song_text = $('#current_song').text();

		$('#player').attr('src', 'files/' + next_song);
		$('#current_song').html(next_song_text);
		$('#music_list').append('<li class="listed_song" id="' + old_song + '">'
								+ old_song_text + '</li>');	
	});

	$('#previous').click(function(){
		// Next song is first in list
		var next_song = $('#music_list li:last').attr('id');
		var next_song_text = $('#music_list li:last').text();

		$('#music_list li:last').remove();

		// Old song is to be put last in list, remove folder from filename
		var old_song = $('#player').attr('src');
		old_song = old_song.replace('files/', '');
		var old_song_text = $('#current_song').text();

		$('#player').attr('src', 'files/' + next_song);
		$('#current_song').html(next_song_text);
		$('#music_list').prepend('<li class="listed_song" id="' + old_song + '">'
								+ old_song_text + '</li>');
	});

	$('#player').bind('ended', function(){
		var repeat = $('#repeat option:selected').val();

		// If repeat single is set, just restart with same song

		if (repeat == 'repeat_track') {
			$(this).attr('src', $(this).attr('src'));
			return;
		}

		// Next song is first in list
		var next_song = $('#music_list li:first').attr('id');
		var next_song_text = $('#music_list li:first').text();

		$('#music_list li:first').remove();

		// Old song is to be put last in list, remove folder from filename
		var old_song = $('#player').attr('src');
		old_song = old_song.replace('files/', '');
		var old_song_text = $('#current_song').text();

		$('#player').attr('src', 'files/' + next_song);
		$('#current_song').html(next_song_text);
		$('#music_list').append('<li class="listed_song" id="' + old_song + '">'
								+ old_song_text + '</li>');

	});

	$('#shuffle').click(function(){

		var files = [];
		var texts = [];
		var songs = [];
		var listed_songs = $('.listed_song');

		var current_song = $('#player').attr('src');
		var current_song_text = $('#current_song').text();
		files.push(current_song);
		texts.push(current_song_text);

		// Loop through, get all filenames
		$.each(listed_songs, function(i, elem){
			files.push($(elem).attr('id'));
			texts.push($(elem).text());
		});

		for (var i=0; i < files.length; i++) {
			files[i] = files[i].replace('files/', '');
		};

		if (texts.length == files.length) {
			for (var i=0; i < files.length; i++) {
				songs[i] = [files[i], texts[i]];
			};
		}
		else {
			return false;
		}

		// Sort randomly
		songs.sort(function() { return 0.5 - Math.random() } );

		$('#music_list').empty();
		for (var i=0; i < songs.length; i++) {
			if (i == 0) {
				$('#player').attr('src', 'files/' + songs[i][0]);
				$('#current_song').html(songs[i][1]);
			}
			else {
				$('#music_list').append('<li class="listed_song" id="'+ songs[i][0] +'">'
										+ songs[i][1] + '</li>');
			}
		};
	});

	// Set some hoverstyles for sortable elements

	$('li').live('mouseover', function(){
		$(this).css({'background-color': '#444'});
	});
	$('li').live('mouseout', function(){
		$(this).css({'background-color': '#111'});
	});

});
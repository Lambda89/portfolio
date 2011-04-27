$(document).ready(function(){
	$('#music_list').sortable();

	$('#player').bind('ended', function(){

		// Next song is first in list
		var next_song = $('#music_list li:first').text();
		$('#music_list li:first').remove();

		// Old song is to be put last in list, remove folder from filename
		var old_song = $('#player').attr('src');
		old_song = old_song.replace(/^[a-z]+\//, '');

		$('#player').attr('src', 'files/' + next_song);
		$('#current_song').html(next_song);
		$('#music_list').append('<li class="listed_song">' + old_song + '</li>');
	});

	$('#shuffle').click(function(){

		var files = [];
		var listed_songs = $('.listed_song');

		// Loop through, get all filenames
		$.each(listed_songs, function(i, elem){
			files.push($(elem).text());
		});

		// Sort randomly
		files.sort(function() { return 0.5 - Math.random() } );

		$('#music_list').empty();
		for (var i=0; i < files.length; i++) {
			$('#music_list').append('<li class="listed_song">' + files[i] + '</li>');
		};
	});
});
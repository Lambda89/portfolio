$(document).ready(function(){
	$('#music_list').sortable();

	$('#player').bind('ended', function(){
		var next_song = $('#music_list li:first').text();
		$('#music_list li:first').remove();
		var old_song = $('#player').attr('src');
		old_song = old_song.replace(/^[a-z]+\//, '');
		$('#player').attr('src', 'files/' + next_song);
		$('#current_song').html(next_song);
		$('#music_list').append('<li>' + old_song + '</li>');
	});
});
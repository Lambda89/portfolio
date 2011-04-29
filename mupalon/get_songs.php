<?php

/**
* 
*/
class GetSongs
{
	function __construct()
	{
		mysql_connect('localhost', 'root', 'abc123');
		mysql_select_db('mupalon');
		$query = "SELECT * FROM `songs` ORDER BY `id` DESC";
		$result = mysql_query($query);
		$i = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$filename = $row['filename'];
			$artist = ($row['artist']) ? $row['artist'] : "N/A"; ;
			$song_name = preg_replace('/\.+([a-zA-Z0-9]{2,4})/', '', $filename);
			// if ($row['artist']) $song_name .= ' - ' . $row['artist'];
			if (!$i) {
				if (stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') == false) {
				$player 
					= '<audio id="player" src="files/' . $filename .'" controls="controls" autoplay="autoplay"> </audio>';
				}
				else {
				$player 
					= '<object data="files/' . $filename . '" type="application/x-mplayer2" width="100%" height="10">'
					. '<param name="filename" value="music.mp3"></object><embed type="application/x-mplayer2" src="file.mp3">';
				}
				$player 
					.= '<div class="current_div"><marquee id="current_song">'
					. $song_name . '<span class="artist"> - ' . $artist .'</span></marquee>';
				$player 
					.= '<input type="button" name="shuffle" value="Shuffle" id="shuffle" />'
					. '<select name="repeat" id="repeat">'
					//. '<option selected="selected" value="no_repeat">No repeat</option>'
					. '<option value="repeat_all">Repeat all</option>'
					. '<option value="repeat_track">Repeat track</option>'
					. '</select>';
				$player .= '</div>';
				$i++;
			}
			else {
				$ret
					.= '<li class="listed_song" id="' . $filename . '">'
					. $song_name . '<span class="artist"> - ' . $artist . '</span></li>';
			}
		}
		$ret = '<ul id="music_list">' . $ret . '</ul>';
		$out = $player . '<br />' . $ret;
		mysql_close();
		echo $out;
		echo $_SERVER['USER_AGENT'];
	}
}

new GetSongs();


?>
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
			if (!$i) {
				$player = '<audio id="player" src="files/' . $filename .'" controls="controls" autoplay="autoplay"></audio>';
				$player .= '<div class="current_div"><marquee id="current_song">' . $filename . '</marquee></div>';
				$i++;
			}
			else {
				$ret .= '<li class="listed_song">' . $filename . '</li>';
			}
		}
		$ret = '<ul id="music_list">' . $ret . '</ul>';
		$out = $player . '<br />' . $ret;
		mysql_close();
		echo $out;
	}
}

new GetSongs();


?>
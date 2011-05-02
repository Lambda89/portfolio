<?php
/**
* Handle management of files, in this small project
*/
class FileManager
{
	function __construct($request)
	{
		if ($request['action'] == 'upload') {
			self::upload_file($request);
		}
		else {
			return false;
		}
	}

	// Handles uploading

	private static function upload_file($request) {
		$cwd = getcwd();

		require('getid3/getid3/getid3.php');

		$id3_obj = new getId3;
		$id3_obj->option_md5_data        = false;
		$id3_obj->option_md5_data_source = false;
		$id3_obj->encoding               = 'UTF-8';

		$result = $id3_obj->analyze($_FILES['song']['tmp_name']);
		if ($result['tags']) {
			foreach ($result['tags'] as $tags) {
				if ($tags['title']) {
					foreach ($tags['title'] as $s) {
						$song .= $s . ' ';
					}
				}
				if ($tags['artist']) {
					foreach ($tags['artist'] as $s) {
						$artist .= $s . ' ';
					}
				}
				if ($tags['album']) {
					foreach ($tags['album'] as $s) {
						$album .= $s . ' ';
					}
				}
			}
		}
		$filename = trim($song) . '.' . trim($result['fileformat']);
		
		if (file_exists($cwd . '/' . 'files/' . $filename)) return false;

		if (move_uploaded_file($_FILES['song']['tmp_name'], 'files/' . $filename)) {
			$ogg_name = trim($song) . '.ogg';

			$convert_file_name = self::escape_song_name($filename);
			$ogg_name = self::escape_song_name($ogg_name);

			shell_exec("/opt/local/var/macports/software/ffmpeg/0.6.2_0/opt/local/bin/ffmpeg -i $cwd/files/$convert_file_name $cwd/files/$ogg_name");

			mysql_connect('localhost', 'root', 'abc123');
			mysql_select_db('mupalon');
			$filename = mysql_real_escape_string($filename);
			$song = mysql_real_escape_string($song);
			$artist = mysql_real_escape_string($artist);
			$album = mysql_real_escape_string($album);
			$query = "INSERT INTO `songs` (`song`, `artist`, `album`, `filename`, `ogg_name`)
						VALUES ('$song', '$artist', '$album', '$filename', '$ogg_name')";
			mysql_query($query);
			mysql_close();
		}
	}

	static private function escape_song_name($filename) {
		$chars = array("(", ")", "'", " ");
		foreach ($chars as $c) {
			$filename = str_replace($c, "\\" . $c, $filename);
		}
		return $filename;
	}
}

new FileManager($_REQUEST);
header('Location: index.php');

?>
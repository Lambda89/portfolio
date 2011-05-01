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

		if (file_exists('files/' . $_FILES['song']['name'])) return false;

		if (move_uploaded_file($_FILES['song']['tmp_name'], 'files/' . $_FILES['song']['name'])) {
			copy('files/' . $_FILES['song']['name'], 'ogg/' . $_FILES['song']['name']);
			$ogg_name = preg_replace('/\.[a-zA-Z0-9]{2,4}/', '', $_FILES['song']['name']) . '.ogg';
			shell_exec('ffmpeg -i ogg/' . $_FILES['song']['name'] . ' ogg/' . $ogg_name);

			require('getid3/getid3/getid3.php');

			$id3_obj = new getId3;
			$id3_obj->option_md5_data        = false;
			$id3_obj->option_md5_data_source = false;
			$id3_obj->encoding               = 'UTF-8';

			$result = $id3_obj->analyze('files/' . $_FILES['song']['name']);
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

			mysql_connect('localhost', 'root', 'abc123');
			mysql_select_db('mupalon');
			$filename = mysql_real_escape_string($_FILES['song']['name']);
			$song = mysql_real_escape_string($song);
			$artist = mysql_real_escape_string($artist);
			$album = mysql_real_escape_string($album);
			$query = "INSERT INTO `songs` (`song`, `artist`, `album`, `filename`)
						VALUES ('$song', '$artist', '$album', '$filename')";
			mysql_query($query);
			mysql_close();
		}
	}
}

if ($_REQUEST) {
	new FileManager($_REQUEST);
	header('Location: index.php');
}

?>
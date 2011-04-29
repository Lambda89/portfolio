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
		if (!$request) return false;

		if (file_exists('files/' . $_FILES['song']['name'])) return false;

		include_once('getid3/getid3/getid3.php');

		$id3_obj = new getId3;
		$id3_obj->option_md5_data        = true;
		$id3_obj->option_md5_data_source = true;
		$id3_obj->encoding               = 'UTF-8';

		$result = $id3_obj->analyze($_FILES['song']['tmp_name']);
		if ($result['tags']) {
			foreach ($result['tags'] as $tags) {
				foreach ($tags['artist'] as $a) {
					$artist = $a . ' ';
				}
			}
		}

		if (move_uploaded_file($_FILES['song']['tmp_name'], 'files/' . $_FILES['song']['name'])) {
			mysql_connect('localhost', 'root', 'abc123');
			mysql_select_db('mupalon');
			$filename = mysql_real_escape_string($_FILES['song']['name']);
			$artist = mysql_real_escape_string($artist);
			$query = "INSERT INTO `songs` (`artist`, `filename`) VALUES ('$artist', '$filename')";
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
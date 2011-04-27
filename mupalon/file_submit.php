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

		if (move_uploaded_file($_FILES['song']['tmp_name'], 'files/' . $_FILES['song']['name'])) {
			mysql_connect('localhost', 'root', 'abc123');
			mysql_select_db('mupalon');
			$filename = mysql_real_escape_string($_FILES['song']['name']);
			$query = "INSERT INTO `songs` (`filename`) VALUES ('$filename')";
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
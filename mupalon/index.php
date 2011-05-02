<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script src="jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="jquery-ui.js" type="text/javascript" charset="utf-8"></script>
	<script src="mupalon.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="mupalon.css" type="text/css" media="screen" charset="utf-8" />
	<title>index</title>
	
</head>

<body>
<div id="wrapper">
	<div id="player_area">
	<?php require('get_songs.php'); ?>
	</div>
	<form action="file_submit.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="mus_sub">
		<input type="hidden" name="action" value="upload" id="action" />
		<p>
			<input type="file" name="song" value="" id="song" />
			<input type="submit" name="submit" value="Upload" />
		</p>
	</form>
</div>
</body>
</html>

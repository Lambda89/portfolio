<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script src="jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="jquery-ui.js" type="text/javascript" charset="utf-8"></script>
	<script src="mupalon.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="mupalon.css" type="text/css" media="screen" charset="utf-8" />
	<title><?php echo ucwords(preg_replace('/(\.php|\/)/', ' | ', $_SERVER['PHP_SELF'])); ?></title>
	
</head>

<body>
<div id="wrapper">
	<div id="player_area">
	<?php require('get_songs.php'); ?>
	</div>
	<a href="upload.php"> Upload more files </a>
</div>
</body>
</html>

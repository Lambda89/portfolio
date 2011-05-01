<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script src="jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="jquery-ui.js" type="text/javascript" charset="utf-8"></script>
	<script src="mupalon.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="mupalon.css" type="text/css" media="screen" charset="utf-8" />
	<title><?php $_SERVER['SCRIPT_NAME']; ?></title>
	
</head>

<body>
<div id="wrapper">
	<form action="file_submit.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="action" value="upload" id="action" />
		<p>
			<input type="file" name="song" value="" id="song" />
			<input type="submit" name="submit" value="Upload" />
		</p>
	</form>
</div>
</body>
</html>

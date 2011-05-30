<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="mupalon.css" type="text/css" media="screen" charset="utf-8" />

	<title><?php echo ucwords(preg_replace('/(\/)/', ' ›› ', $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'])); ?></title>
	
</head>

<body>
<div id="wrapper">
	<h2> Mupalon Music File Uploader </h2>
	<div id="new_song_form">
		<form action="file_submit.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="mus_sub">
			<input type="hidden" name="action" value="upload" id="action" />
			<p>
				<input type="file" name="song" value="" id="song" />
				<input type="submit" name="submit" value="Upload" />
			</p>
		</form>
	</div>
</div>
</body>
</html>

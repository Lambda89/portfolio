<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" charset="utf-8" />
	<title><?php echo $_SERVER['PHP_SELF']; ?></title>
	
</head>

<body>
<div id="wrapper">
	<div id="header">
		<h2> <a href="index.php"> Just a very simple blog </a> </h2>
	</div>
	<div id="content">
	<?php
	require_once(dirname(__FILE__) . '/routes/posts.route.php');
	?>
	</div>
	<div id="sidebar">
	</div>
	<div id="footer">
	</div>
	<br id="clear" />
</div>
</body>
</html>

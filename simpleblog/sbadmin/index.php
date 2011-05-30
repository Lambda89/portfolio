<?php
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/../classes/user.class.php');
if (!is_numeric($_SESSION['id']) || $_SESSION['is_admin'] != true) {
	header('Location: login.php');
	exit;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<link rel="stylesheet" href="../css/default.css" type="text/css" media="screen" charset="utf-8" />
	<title><?php echo $_SERVER['PHP_SELF']; ?></title>
	
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<h2> Just a very simple admin-view </h2>
		</div>
		<div id="content">
			<?php
				if (isset($_REQUEST['list'])) {
					if ($_REQUEST['list'] == "posts") {
						require(dirname(__FILE__) . '/../routes/posts.route.php');
					}
				}
			?>
		</div>
		<div id="sidebar">
			<ul id="admin_sidebar_list">
				<li><a href="?list=posts"> Posts </a></li>
				<li><a href="?list=comments"> Kommentarer </a></li>
				<li><a href="?list=sidebar_modules"> Sidebar Modules </a></li>
			</ul>
		</div>
		<div id="footer">
		</div>
		<br id="clear" />
	</div>
</body>
</html>

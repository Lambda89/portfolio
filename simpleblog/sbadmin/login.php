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
	<div id="login_wrapper">
		<form action="../routes/user.route.php" method="post" accept-charset="utf-8">
			<p>
				<label for="username">Användarnamn</label><br />
				<input type="text" name="username" value="" id="username" />
			</p>
			<p>
				<label for="password">Lösenord</label><br />
				<input type="password" name="pwd" value="" id="pwd" />
			</p>
			<input type="hidden" name="action" value="login" id="action">
			<p><input type="submit" value="Logga in"></p>
		</form>
	</div>
</div>
</body>
</html>

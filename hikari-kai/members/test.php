<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Kick banned, you ain\'t admin. God did just now kill a kitten';
    exit;
} else {
	if ($_SERVER['PHP_AUTH_PW']=="boxxymudkip")
    		echo "";
	else
		die("FUCKED!");
}
?>

<?php
error_reporting(E_ALL);
die();
exit;

require('../classes/application.class.php');

/**
* 
*/
class register extends Application
{
	function __construct()
	{
		$un = "rickard";
		$pw = "lund";

		$pw = Application::hash_string($pw, "SHA512");

		Application::query("INSERT INTO users (username, password) VALUES('$un', '$pw')");
	}
}

new register();


?>
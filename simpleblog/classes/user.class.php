<?php
require_once('application.class.php');
/**
* 
*/
class User extends Application
{
	private static $table = 'users';
	private static $key = array('username', 'password');

	public function __construct()
	{
		session_start();
	}
	
	public static function login($request) {
		if (isset($request['username']) && isset($request['pwd'])) {
			$request['username'] = Application::clean($request['username']);
			$request['pwd'] = Application::hash_string($request['pwd'], "SHA512");
			$data = Application::single(self::$table, self::$key, $request);
			if ($data->num_rows > 1 || $data->num_rows < 1) { return false; }
			$data = Application::fetch_assoc($data);
			if ($data[0]['username'] == $request['username'] && $data[0]['password'] == $request['pwd']) {
				$_SESSION['id'] = $data[0]['id'];
				$_SESSION['is_admin'] = true;
				return true;
			}
			else {
				unset($_SESSION);
				session_destroy();
				return false;
			}
		}
	}
}


$user = new User();

?>
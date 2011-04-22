<?php

require(dirname(__FILE__).'/Application.php');

/**
* 
*/
class Admin extends Application
{
	
	private static $admin;
	
	static function setAdmin()
	{
		if (Admin::$admin == null) {
			session_start();

			if (isset($_SESSION['is_admin']) && is_numeric($_SESSION['is_admin'])) {
				Admin::$admin = parent::escape($_SESSION['id'], "xss");
			} else {
				Admin::$admin = null;
				session_destroy();
			}
		}
	}
	
 	static function getAdmin()
	{
		return Admin::$admin;
	}
	
	static function login($hash)
	{
		foreach ($hash as $key => $value) {
			if (empty($value)) {
				return "Ett eller flera fält lämnades tomt.";
			}
			
			$hash[$key] = parent::escape($value, 'sql');
		}
		
		$hash['password'] = parent::hash_string($hash['password'], "SHA512");
		
		$result = parent::query("SELECT `id`, `username`, `password` 
								FROM `users`
								WHERE LOWER(`username`) = LOWER('{$hash['username']}')
								AND `password` = '{$hash['password']}'
								LIMIT 1
							");
							
		if (is_array($result)) {
			foreach ($result as $keys => $users) {
				if ($users['id'] && $users['username'] == strtolower($hash['username']) && $users['password'] == $hash['password']) {
					
					session_start();
					
					if (is_numeric($users['id'])) {
						$_SESSION['user_id'] = intval(trim($users['id']));
					}
					else {
						self::logout();
						
						return "Användarkontot existerar inte.";
					}
					
					if ((isset($_SESSION['user_id']) && ($_SESSION['user_id'] < 1 || $_SESSION['user_id'] > 800)) {
						self::logout();
						
						return "Allvarligt intrångsförsök.";
					}
					
					return "Success";
				}
				else {
					return "Användarnamnet eller lösenordet matchar inte någon användare.";
				}
			}
		} else {
			return "Användarnamnet eller lösenordet matchar inte någon användare.";
		}

	}
}


?>
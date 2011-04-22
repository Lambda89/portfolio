<?php

/**
* 
*/
class Application
{
	
	static private $connection;
	
	static function getInstance() {
		
		if (Application::$connection == null) {
			
			include(dirname(__FILE__).'/../config/config.dist.php');
			
			Application::$connection = new mysqli($config['host'], $config['username'], $config['password']);
				mysqli_select_db(Application::$connection, $config['db']);
		}
		
		return Application::$connection;
	}
	
	static function query($sql) {
		$result = Application::getInstance()->query($sql);
		
		if ($result === true) {
			return true;
		}
		else if ($result === false) {
			return Application::getInstance()->error;
		}
		else {
			while ($row = $result->fetch_assoc()) {
				$array[] = $row; 
			}
			
			return $array;
		}
	}
	
	static function escape($string, $type) {
		
		if (is_numeric($string)) {
			return $string;
		}
		
		switch ($type) {
			case 'xss':
				return htmlspecialchars($string);
				break;
			case 'sql':
				return mysql_real_escape_string($string);
				break;
			case 'both':
				return htmlspecialchars(mysql_real_escape_string($string));
				break;
			default:
				return null;
				break;
		}
		
	}
	
	static function match($string, $type) {
		
		switch ($type) {
			case 'email':
				return preg_match('/^([a-zA-Z0-9-.+_])+@([a-zA-Z0-9-_])+\.([a-zA-Z0-9]{2,5})+$/', $string);
				break;
			case 'phone':
				return preg_match('/^([0-9-]){6,20}+$/', $string);
				break;
			case 'ssn':
				return preg_match('/^([0-9]){6}+-([0-9]){4}$/', $string);
				break;
			default:
				return false;
				break;
		}
		
	}
	
	static function hash_string($string, $type) {
		include(dirname(__FILE__).'/../config/config.dist.php');
		
		return hash($type, $string.$config['salt']);
	}
	
	static function last_id() {
		return Application::getInstance()->insert_id();
	}
	
}


?>
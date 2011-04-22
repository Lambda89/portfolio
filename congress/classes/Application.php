<?php

/**
* Application.php, 2010-09-30, Rickard Lund
*
* This file/class handles general operations within the application.
*/
class Application
{
	
	private $conn;	
	
	function __construct()
	{
		$conn = mysql_connect("localhost", "root", "abc123");
			$this->conn = mysql_select_db("hb_kongressen");
	}
	
	public function query($SQL)
	{
		$query = mysql_query($SQL);
		
		if ($query === true) {
			return true;
		}
		else if ($query === false) {
			return false;
		}
		else {
			
			$array = array();
			
			while ($row = mysql_fetch_assoc($query)) {
				$array[] = $row;
			}
			return $array;
		}	
	}
	
	public function clean($string)
	{
		if (is_numeric($string)) {
			return $string;
		} else {
			return mysql_real_escape_string(htmlspecialchars($string));
		}
	}
	
	public function hash($string)
	{
		return hash("SHA512", $string."xVyZ1$!sD");
	}
	
	public function last_id()
	{
		return mysql_insert_id();
	}
}


?>
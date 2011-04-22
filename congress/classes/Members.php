<?php
require_once('Application.php');
/**
* 
*/
class Members extends Application
{
	
	private $conn;	
	
	function __construct()
	{
		$conn = mysql_connect("localhost", "root", "abc123");
			$this->conn = mysql_select_db("hb_members");
	}
	
	public function saveMember($hash, $topic, $message)
	{
		foreach ($hash as $key => $value) {
			$hash[$key] = Application::clean($value);
		}
		
		$columns = "`first_name`, `last_name`, `email`, `phone`, `interest_group`, `street_address`, `postal_code`, `location`";
		
		$values = "'".$hash['first-name']."', '".$hash['last-name']."', '".$hash['eaddr']."', '".$hash['phone']."', '".$hash['interest-group']."', '".$hash['street-address']."', '".$hash['postal-code']."', '".$hash['location']."'";
		
		if (!Application::query("INSERT INTO `members` ($columns) VALUES ($values)")) {
		 	if (!mail($hash['eaddr'], $topic, $message)) {
		 		return false;
		 	} else {
				return true;
			}
		} else {
			return true;
		}
	}
	
}


?>
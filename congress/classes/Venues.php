<?php
require_once('Application.php');
/**
* 
*/
class Venues extends Application
{
	
	public function getVenues()
	{
		$row = Application::query("SELECT * FROM `venues` ORDER BY `id` ASC");
		
		return $row;
	}
	
	public function insertVenue($array)
	{
		foreach ($array as $key => $value) {
			if (empty($value)) {
				return false;
			}
		}
		
		foreach ($array as $key => $value) {
			$array[$key] = Application::clean($value);
		}
		
		if (!preg_match('/[0-9]/', $array['cost'])) {
			return false;
		}
		
		$columns = "`title`, `cost`, `venue_type`";
		
		$values = "'".$array['title']."', '".$array['cost']."', '".$array['venue_type']."'";
		
		if (Application::query("INSERT INTO `venues` ($columns) VALUES($values)")) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updateVenue($array)
	{
		foreach ($array as $key => $value) {
			$array[$key] = Application::clean($value);
		}
		
		if (Application::query(
				"UPDATE `venues` 
				 SET `title`='{$array['title']}', `cost`='{$array['cost']}', `venue_type`='{$array['venue_type']}'
				 WHERE `id` = '{$array['id']}'")
		) {
			return true;
		} else {
			return false;
		}
	}
	
}


?>
<?php

require_once('Application.php');

/**
* 
*/
class DatesAndTimes extends Application
{

	public function getDate($type)
	{
		$app = new Application();
		
		//Clean date and type
		
		$type = $app->clean($type);
		
		$row = $app->query("SELECT * FROM `dates` WHERE `type` = '$type'");
		
		return $row;
	}

	public function setDate($date, $type)
	{
		$app = new Application();
		
		//Clean date and type
		
		$date = $app->clean($date);
		$type = $app->clean($type);
		
		if (!preg_match('/([0-9]{4}-)+([0-9]{2}-)+([0-9]{2})+$/', $date)) {
			return false;
		}
		
		//Perform update of certain date. $type may for instance be "end_date", or something like it.
		//The idea for this function is to work as a conduit for changing a lot of dates, in the
		//dates table, without having to write specific functions for each type. 
		
		if (!$app->query("UPDATE `dates` SET `date` = '$date' WHERE `type` = '$type'")) {
			return false;
		} else {
			return true;
		}
	}
	
	public function checkDate($date, $type)
	{
		$app = new Application();
		
		//Clean date and type
		
		$date = $app->clean($date);
		$type = $app->clean($type);
		
		//Fetch from database ...
		
		$row = $app->query("SELECT * FROM `dates` WHERE `type` = '$type'");
		
		//This functions main purpose is to make sure that today's date
		//isn't past the set end-date. (Ps. I love that Date is it's own data-type)
		
		if ($date < $row[0]['date']) {
			return true;
		} else {
			return false;
		}
	}
	
}


?>
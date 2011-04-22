<?php

require_once('simpletest/autorun.php');

/**
* 
*/

require_once(dirname(__FILE__).'/../classes/DatesAndTimes.php');

class DatesAndTimesTest extends UnitTestCase
{
	
	public function testGetDate()
	{
		$dt = new DatesAndTimes();
		
		$type = "primary";
		
		$row = $dt->getDate($type);
		
		$this->assertEqual($row[0]['date'], date("Y-m-d"));
	}
	
	public function testSetDate()
	{
		$dt = new DatesAndTimes();
		
		$date = "2011-11-10";
		$type = "primary";
		
		$this->assertTrue($dt->setDate($date, $type));
	}
	
	public function testCheckDate()
	{
		$dt = new DatesAndTimes();
		
		$date = 
		
		$dt->setDate("2011-01-12", "primary");
		
		$this->assertTrue($dt->checkDate(date("Y-m-d"), "primary"));
		
		$dt->setDate("2010-01-12", "primary");
		
		$this->assertTrue($dt->checkDate(date("Y-m-d"), "primary") === false);
		
		$dt->setDate(date("Y-m-d"), "primary");
		
		$this->assertTrue($dt->checkDate(date("Y-m-d"), "primary") === false);
		
	}
}


?>
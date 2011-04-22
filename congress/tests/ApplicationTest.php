<?php
require_once('simpletest/autorun.php');
/**
* 
*/

require_once(dirname(__FILE__).'/../classes/Application.php');

class ApplicationTest extends UnitTestCase
{

	public function testConnection()
	{
		require_once('test_helpers.php');
		$app = new Application();
		
		$this->assertTrue($app);
	}
	
	public function testQuery()
	{
		require_once('test_helpers.php');
		$app = new Application();
		$th = new TestHelpers();
		
		$this->assertTrue($app->query("INSERT INTO `tickets` (`first_name`) VALUES ('Rickard')"));
		$this->assertFalse($app->query("SELECT * FROM WHERE"));
		$this->assertTrue(is_array($app->query("SELECT * FROM `tickets`")));
		
		$th->cleanTable("tickets");
	}
	
	public function testEscaping()
	{
		require_once('test_helpers.php');
		$app = new Application();
		
		$string = "OR 'DROP TABLE'";
		$clean_string = $app->clean($string);
		$this->assertEqual($clean_string, "OR \'DROP TABLE\'");
	}

}


?>
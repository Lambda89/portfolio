<?php

require_once('simpletest/autorun.php');

/**
* 
*/

require_once(dirname(__FILE__).'/../classes/Members.php');

class MembersTest extends UnitTestCase
{

	public function testSaveMember()
	{
		require_once('test_helpers.php');
		$th = new TestHelpers();
		
		$hash = array('first-name' => "Rickard", 'last-name' => "Lund", 'eaddr' => "natural_blindfold@hotmail.com", 'phone' => "0738030259", 'interest-group' => "Privatperson", 'street-address' => "Kometgatan 21", 'postal-code' => "41520", 'location' => "Göteborg");
		
		$mem = new Members();
		
		$topic = "Hej";
		$message = "Dårårårårå.";
		
		$this->assertTrue($mem->saveMember($hash, $topic, $message));
		
		$th->cleanTable("members");
	}

}


?>
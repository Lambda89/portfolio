<?php
require_once('simpletest/autorun.php');
/**
* 
*/
class AllTests extends TestSuite
{
	
	function AllTests()
	{
		$this->TestSuite('All tests');
		$this->addFile(dirname(__FILE__).'/ApplicationTest.php');
		$this->addFile(dirname(__FILE__).'/TicketsTest.php');
		$this->addFile(dirname(__FILE__).'/UsersTest.php');
		$this->addFile(dirname(__FILE__).'/MembersTest.php');
		$this->addFile(dirname(__FILE__).'/DatesAndTimesTest.php');
	}
}


?>
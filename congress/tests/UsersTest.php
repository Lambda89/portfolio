<?php

require_once('simpletest/autorun.php');
/**
* 
*/

require_once(dirname(__FILE__).'/../classes/Users.php');

class UsersTest extends UnitTestCase
{
	
	public function testLogin()
	{
		$usr = new Users();
		
		require_once('test_helpers.php');
		$th = new TestHelpers();
		
		$th->insertUser();
		
		$hash = array('username' => "rickard", 'pwd' => "apakaka");
		
		$usr->login($hash);
		
		$this->assertTrue(isset($_SESSION['id']));
		$this->assertFalse(isset($_SESSION['is_admin']));
		
		$th->cleanTable("users");
	}
	
	public function testRegister()
	{
		$usr = new Users();
		
		require_once('test_helpers.php');
		$th = new TestHelpers();
		
		$hash = array('username' => "rickard", 'pwd' => "apakaka", 'conf-pwd' => 'apakaka', 'eaddr' => "rickard@oribium.net");
		
		$result = $usr->register($hash);
		
		$this->assertTrue($result);
		
		$th->cleanTable("users");
	}
	
	public function testGetUsers()
	{
		$usr = new Users();
		
		require_once('test_helpers.php');
		$th = new TestHelpers();
		
		$hash = array('username' => "rickard", 'pwd' => "apakaka", 'conf-pwd' => 'apakaka', 'eaddr' => "rickard@oribium.net");
		
		$usr->register($hash);
		
		$row = array();
		
		$row = $usr->getUsers();
		
		$this->assertTrue(in_array("rickard", $row[0]));
		$this->assertTrue($row[0]['email'] == "rickard@oribium.net");
		
		$th->cleanTable("users");
	}
	
	public function testeDeleteUser()
	{
		$usr = new Users();
		
		require_once('test_helpers.php');
		$th = new TestHelpers();
		
		$hash = array('username' => "rickard", 'pwd' => "apakaka", 'conf-pwd' => 'apakaka', 'eaddr' => "rickard@oribium.net");
		
		$usr->register($hash);
		
		$id = 1;
		
		$this->assertTrue($usr->deleteUser($id));
		
		$th->cleanTable("users");
	}
	
	public function testResetPassword()
	{
		$usr = new Users();
		
		require_once('test_helpers.php');
		$th = new TestHelpers();
		
		$hash = array('username' => "rickard", 'pwd' => "apakaka", 'conf-pwd' => 'apakaka', 'eaddr' => "rickard@oribium.net");
		
		$usr->register($hash);
		
		$this->assertTrue($usr->resetPassword("rickard@oribium.net", "Hej", "Återställt"));
		
		$this->assertFalse($usr->resetPassword("rickard@oribium.com", "Hej", "Återställt"));
		
		$th->cleanTable("users");
	}
	
}


?>
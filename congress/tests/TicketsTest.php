<?php
require_once('simpletest/autorun.php');
/**
* 
*/

require_once(dirname(__FILE__).'/../classes/Tickets.php');

class TicketsTest extends UnitTestCase
{
	
	public function testGetTickets()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('ticket_type' => "1", 'first_name' => "Rickard", 'last_name' => "Lund", 'eaddr' => "rickard@oribium.se", 'phone' => "0738030259", 'address' => "Kometgatan 21", 'postal_code' => "415 20", 'location' => "Göteborg", 'user_id' => "1");
		
		$tick->insertTicket($hash);
		
		$user_id = 1;
		
		$row = $tick->getTickets($user_id);
				
		$this->assertEqual($row[0]['first_name'], "Rickard");
		
		$th->cleanTable("tickets");
	}
	
	public function testInsertTickets()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('ticket_type' => "A", 'first_name' => "Rickard", 'last_name' => "Lund", 'eaddr' => "rickard@oribium.se", 'phone' => "0738030259", 'address' => "Kometgatan 21", 'postal_code' => "415 20", 'location' => "Göteborg");
		
		$this->assertTrue($tick->insertTicket($hash));
		
		$th->cleanTable("tickets");
	}
	
	public function testUpdateTicket()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('title' => "Hej kom och hjälp mig", 'number_of_days' => "1");
		
		$tick->insertTicketType($hash);
		
		$hash = array('ticket_type' => "1", 'first_name' => "Rickard", 'last_name' => "Lund", 'eaddr' => "rickard@oribium.se", 'phone' => "0738030259", 'address' => "Kometgatan 21", 'postal_code' => "415 20", 'location' => "Göteborg", 'user_id' => "1");
		
		$tick->insertTicket($hash);
		
		$user_id = 1;
		
		$row = $tick->getTickets($user_id);
		
		$this->assertEqual($row[0]['first_name'], "Rickard");
		
		$hash = array('id' => '1', 'ticket_type' => "1", 'first_name' => "Rolf Rickard", 'last_name' => "Lund", 'eaddr' => "rickard@oribium.se", 'phone' => "0738030259", 'address' => "Kometgatan 21", 'postal_code' => "415 20", 'location' => "Göteborg", 'user_id' => "1");
		
		$tick->updateTicket($hash);
		
		$row = $tick->getTickets($user_id);
		
		$this->assertEqual($row[0]['first_name'], "Rolf Rickard");
		
		$th->cleanTable("tickets");
	}
	
	public function testDeleteTicket()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('ticket_type' => "1", 'first_name' => "Rickard", 'last_name' => "Lund", 'eaddr' => "rickard@oribium.se", 'phone' => "0738030259", 'address' => "Kometgatan 21", 'postal_code' => "415 20", 'location' => "Göteborg", 'user_id' => "1");
		
		$tick->insertTicket($hash);
		
		$id = '1';
		$user_id = '1';
		
		$tick->deleteTicket($id, $user_id);
		
		$row = Application::query("SELECT * FROM `tickets`");
				
		$this->assertTrue(empty($row[0]));
		
		$th->cleanTable("tickets");
	}
	
	public function testApprovePayment()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('ticket_type' => "1", 'first_name' => "Rickard", 'last_name' => "Lund", 'eaddr' => "rickard@oribium.se", 'phone' => "0738030259", 'address' => "Kometgatan 21", 'postal_code' => "415 20", 'location' => "Göteborg", 'user_id' => "1");
		
		$tick->insertTicket($hash);
		
		$id = '1';
		$user_id = '1';
		
		$tick->approvePayment($id, $user_id);
		
		$row = Application::query("SELECT * FROM `tickets`");
				
		$this->assertEqual($row[0]['payment_received'], '1');
	}
	
	public function testGetTicketTypes()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('title' => "Hej kom och hjälp mig", 'number_of_days' => "1", 'cost' => 200);
		
		$tick->insertTicketType($hash);
		
		$hash = array('title' => "Vänsterspecialare", 'number_of_days' => "3", 'cost' => 500);
		
		$tick->insertTicketType($hash);
		
		$row = $tick->getTicketTypes();
				
		$this->assertTrue(in_array("1", $row[0]));
		$this->assertTrue(in_array("3", $row[1]));
		
		$th->cleanTable("ticket_types");
	}
	
	public function testInsertTicketType()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('title' => "Hej kom och hjälp mig", 'number_of_days' => "3", 'cost' => 200);
		
		$this->assertTrue($tick->insertTicketType($hash));
		
		$th->cleanTable("ticket_types");
	}
	
	public function testUpdateTicketType()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('title' => "Hej kom och hjälp mig", 'number_of_days' => "3", 'cost' => 200);
		
		$tick->insertTicketType($hash);
		
		$result = Application::query("SELECT * FROM `ticket_types`");
		
		$this->assertEqual($result[0]['number_of_days'], "3");
		
		$hash = array('id' => "1", 'title' => "Rakka fett", 'number_of_days' => "2");
		
		$tick->updateTicketType($hash);
		
		$result = Application::query("SELECT * FROM `ticket_types`");
		
		$this->assertEqual($result[0]['title'], "Rakka fett");
		$this->assertEqual($result[0]['number_of_days'], "2");
		
		$th->cleanTable("ticket_types");
	}
	
	public function testDeleteTicketType()
	{
		require_once('test_helpers.php');
		$tick = new Tickets();
		$th = new TestHelpers();
		
		$hash = array('title' => "Hej kom och hjälp mig", 'number_of_days' => "3");
		
		$tick->insertTicketType($hash);
		
		$id = Application::last_id();
		
		$tick->deleteTicketType($id);
		
		$result = Application::query("SELECT * FROM `ticket_types`");
		
		$this->assertTrue(empty($result[0]));
	}

}

?>
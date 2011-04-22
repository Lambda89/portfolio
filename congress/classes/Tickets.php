<?php

require_once('Application.php');

/**
* Tickets.php, 2010-09-30, Rickard Lund
*
* This file/class handles all actions concerning tickets.
*/

class Tickets extends Application
{
	
	public function getTickets($user_id)
	{
		//Clean user-id
		
		$user_id = Application::clean($user_id);
		
		//Perform query, store in row
		
		$row = (Application::query("SELECT *
									FROM `ticket_types` 
									RIGHT JOIN `tickets` 
									ON tickets.ticket_type = ticket_types.id
									WHERE `user_id` = '$user_id'
									GROUP BY tickets.id "));
											
		//Return row
		
		return $row; 
	}
	
	public function insertTicket($array)
	{
		//First, clean all input parameters.
		
		foreach ($array as $key => $value) {
			$array[$key] = Application::clean($value);
		}
		
		//Create insert-strings
		
		$columns = "`ticket_type`, `first_name`, `last_name`, `email`, `phone`, `address`, `postal_code`, `location`, `user_id`";
					
		$values = "'".$array['ticket_type']."', '".$array['first_name']."', '".$array['last_name']."', '".$array['eaddr']."',
		'".$array['phone']."', '".$array['address']."', '".$array['postal_code']."', '".$array['location']."' , '".$array['user_id']."'";
		
		//Perform query
		
		if (!Application::query("INSERT INTO `tickets` ($columns) VALUES ($values)")) {
			return false;
		} else {
			return true;
		}
		
	}
	
	public function updateTicket($array)
	{
		foreach ($array as $key => $value) {
			$array[$key] = Application::clean($value);
		}
		
		Application::query(
						"UPDATE `tickets`
						 SET `ticket_type`='{$array['ticket_type']}', 
						`first_name`='{$array['first_name']}', 
						`last_name`='{$array['last_name']}', 
						`email`='{$array['eaddr']}', 
						`phone`='{$array['phone']}', 
						`address`='{$array['address']}', 
						`postal_code`='{$array['postal_code']}', 
						`location`='{$array['location']}'
						 WHERE `id` = '{$array['id']}'
						 AND `user_id` = '{$array['user_id']}'"
					);
	}
	
	public function deleteTicket($id, $user_id)
	{
		$id = Application::clean($id);
		$user_id = Application::clean($user_id);
		
		Application::query(
						"DELETE FROM `tickets`
						 WHERE `id` = '$id'
						 AND `user_id` = '$user_id'
						 LIMIT 1"
					);
	}
	
	public function approvePayment($id, $user_id)
	{
		$id = Application::clean($id);
		$user_id = Application::clean($user_id);
		
		Application::query(
						"UPDATE `tickets`
						 SET `payment_received` = '1'
						 WHERE `id` = '$id'
						 AND `user_id` = '$user_id'
						 LIMIT 1"
					);
	}
	
	public function getTicketTypes()
	{
		// Perform query
		
		$row = Application::query("SELECT * FROM `ticket_types` ORDER BY `id` ASC");
		
		//Return row
		
		return $row;
	}
	
	public function insertTicketType($array)
	{
		foreach ($array as $key => $value) {
			if (empty($value)) {
				return false;
			}
		}
		
		//Clean all input-parameters
		
		foreach ($array as $key => $value) {
			$array[$key] = Application::clean($value);
		}
		
		if (!preg_match('/[0-9]/', $array['cost'])) {
			return false;
		}
		
		//Create insert-strings
		
		$columns = "`title`, `number_of_days`, `cost`";
		
		$values = "'".$array['title']."', '".$array['number_of_days']."', '".$array['cost']."'";
		
		//Do query
		
		if (Application::query("INSERT INTO `ticket_types` ($columns) VALUES ($values)")) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updateTicketType($array)
	{
		//Clean all parameters
		
		foreach ($array as $key => $value) {
			$array[$key] = Application::clean($value);
		}
		
		//Perform query to update ticket-type
		
		if (Application::query(
				"UPDATE `ticket_types` 
				 SET `title`='{$array['title']}', `cost`='{$array['cost']}', `number_of_days`='{$array['number_of_days']}'
				 WHERE `id` = '{$array['id']}'")
		) {
			return true;
		} else {
			return false;
		}
	}
	
	public function deleteTicketType($id)
	{
		//Clean ticket-type-id
		
		$id = Application::clean($id);
		
		//Perform query to delete
		
		if (Application::query(
				"DELETE FROM `ticket_types`
				 WHERE `id` = '$id'")
		) {
			return true;
		} else {
			return false ;
		}
	}
	
}


?>
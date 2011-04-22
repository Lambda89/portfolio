<?php

if (stristr($_SERVER['REQUEST_URI'], "model")) {
	header('Location: ../index.php');
	die();
}

/**
*  Will contain all standardized, generalized or equally "multi-task"-functions that will be operating throughout the system.
*/

class MainModel
{
	//Construct, connects to the database
	
	private $conn;
	
	function __construct()
	{
		$conn = mysql_connect("localhost", "akira", "wingman");
			$this->conn = mysql_select_db("hikari3");
	}
	
	function query($SQL)
	{
		return mysql_query($SQL);
	}
	
	function fetch($result)
	{
		return mysql_fetch_assoc($result);
	}
	
	function clean($parameter)
	{
		if (is_numeric($parameter)) {
			return $parameter;
		} else {
			$parameter = htmlspecialchars($parameter);
			return mysql_real_escape_string($parameter);
		}
	}
	
	function hash($string)
	{
		$salt = "?d#kkRt3hT7aXp";
		
		$string = hash("SHA512", $string.$salt);
		$string = hash("SHA512", $salt.$string);
		
		return $string;
	}
	
	//SQL-functions
	
	function index($table, $column, $order)
	{
		return "SELECT * FROM `$table` ORDER BY `$column` ".$order;
	}
	
	function subIndex($table, $column, $parameter, $orderColumn, $order)
	{
		return "SELECT * FROM `$table` WHERE `$column` = ".$parameter." ORDER BY `$orderColumn` ".$order;
	}
	
	function show($table, $column, $parameter)
	{
		return "SELECT * FROM `$table` WHERE `$column` = ".$parameter." LIMIT 1";
	}
	
	function create($table, $columns, $values)
	{
		return "INSERT INTO `$table` ($columns) VALUES ($values)";
	}
	
	function update($table, $updateClause, $column, $parameter)
	{
		return "UPDATE `$table` SET $updateClause WHERE `$column` = ".$parameter;
	}
	
	function delete($table, $column, $parameter)
	{
		return "DELETE FROM `$table` WHERE `$column` = ".$parameter;
	}
	
	function validate($table, $firstColumn, $secondColumn, $firstParameter, $secondParameter)
	{
		return "SELECT * FROM `$table` WHERE `$firstColumn` = '$firstParameter' AND `$secondColumn` = '$secondParameter' LIMIT 1";
	}
	
	function search($table, $searchColumn, $parameter, $sortColumn, $order)
	{
		return "SELECT * FROM `$table` WHERE `$searchColumn` LIKE '%$parameter%' ORDER BY `$sortColumn` $order";
	}
	
}


?>

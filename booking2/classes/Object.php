<?php
/**
* 
*/
class Object
{
	
	private static $table_name = "users";
	private static $keys_values =
		array(
			'id' 		=> '',
			'username' 	=> '',
			'password' 	=> '',
			'name' 		=> '',
			'ssn' 		=> '',
			'email' 	=> '',
			'phone' 	=> '',
			'country' 	=> ''
		);
	public $values = array();
	private static $update_values =
		array(
			/* $_REQUEST['username'],
			$_REQUEST['password'],
			$_REQUEST['name'],
			$_REQUEST['ssn'],
			$_REQUEST['eaddr'],
			$_REQUEST['phone'],
			$_REQUEST['country'] */
		);
		
	/* Factory methods */
	
	static function getById($id)
	{
		return self::getBy(array('id' => $id), $table_name);
	}
	
	private static function getBy($lookup, $table) {
		
		mysql_connect();
		mysql_select_db();
		
		$select = "SELECT $table.* FROM $table";
		
		$where = "";
		
		foreach ($lookup as $key => $value) {
			($where == "") ? $where .= " WHERE `$key`='$value' " : $where .= " AND `$key`='$value' ";
		}
		
		$limit = "LIMIT 1";
		
		$result = mysql_query($select.$where.$limit);
		
		self::$keys_values = mysql_fetch_assoc($result);
		
		return self::$keys_values;
	}

}

$obj = Object::getById(1);

echo $obj->name;


?>
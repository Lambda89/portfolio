<?php

/**
* 
*/
class Application
{
	public static $instance;

	public static function get_instance() {
		if (Application::$instance == null) {
			Application::$instance = new mysqli('localhost', 'root', 'abc123');
			mysqli_select_db(Application::$instance, 'simpleblog');
		}
		return Application::$instance;
	}

	protected static function query($sql) {
		return Application::get_instance()->query($sql);
	}

	protected static function fetch_assoc($result) {
		$arr = array();
		while ($row = $result->fetch_assoc()) {
			$arr[] = $row;
		}
		return $arr;
	}

	public static function clean($string) {
		return Application::get_instance()->real_escape_string($string);
	}

	public static function hash_string($string, $type) {
		$salt = "xva1d39r#1";
		return hash($type, $string.$salt);
	}

	/* SQL-query-functions */
	
	protected static function index($table) {
		return self::query("SELECT * FROM `$table` ORDER BY `id` DESC");
	}

	protected static function single($table, $key, $lookup) {
		$lookup = self::format_lookup($key, $lookup);
		return self::query("SELECT * FROM `$table` WHERE $lookup LIMIT 1");
	}

	protected static function create($table, $columns, $values) {
		$insert = self::format_insert($columns, $values);
		self::query("INSERT INTO `$table` ({$insert['columns']}) VALUES({$insert['values']})");
	}

	protected static function update($table, $key, $lookup, $columns, $values) {
		$update = self::format_update($columns, $values);
		self::query("UPDATE `$table` SET $update WHERE `$key` = '$lookup' LIMIT 1");
	}

	protected static function delete($table, $key, $lookup) {
		$lookup = self::format_lookup($key, $lookup);
		return self::query("DELETE FROM `$table` WHERE $lookup LIMIT 1");
	}

	/* SQL-formatting-functions */

	private static function format_lookup($key, $lookup) {
		if (is_array($key) && is_array($lookup)) {
			$i = 0;
			foreach ($lookup as $value) {
				$values[] = "`" . $key[$i] . "` = '$value'";
				$i++;
			}
			return implode(" AND ", $values);
		}
		else {
			return "`" . $key . "` = '" . $lookup . "'";
		}
	}

	private static function format_insert(array $columns, array $values) {
		if (count($columns) == count($values)) {
			foreach ($columns as $column) {
				$column = '`' . self::clean($column) . '`';
			}
			$columns = implode(',', $columns);
			foreach ($values as $value) {
				$value = "'" . self::clean($value) . "'";
			}
			$values = implode(',', $values);
			return array('columns' => $column, 'values' => $values);	
		}
		else {
			return false;
		}
	}

	private static function format_update(array $columns, array $values) {
		if (count($columns) == count($values)) {
			$i = 0;
			foreach ($values as $key => $value) {
				$update[] = "`" . $columns[$i] . "` = '$value'";
				$i++;
			}
			$update = implode(',', $update);
			return $update;
		}
		else {
			return false;
		}
	}

	/* Validation-functions */

	private static function validate_email($email_address) {
		return preg_match('/([a-zA-Z0-9\.\+\-\_])+@([a-zA-Z0-9\-\_])+\.([a-zA-Z0-9]){2,5}/', $email_address);
	}

	private static function validate_phone($phone_number) {
		return preg_match('/[0-9\-]/', $phone_number);
	}
}


?>
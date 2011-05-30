<?php

/**
* 
*/
class Comments extends Application
{
	private static $table = 'comments';
	private static $key = 'id';
	private static $sub_key = 'post_id';
	
	public static function printAllCommentsOfPost($id) {
		$data = Application::sub_index(self::$table, self::$sub_key, $id);
	}
}


?>
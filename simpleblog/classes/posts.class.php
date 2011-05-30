<?php
require_once('application.class.php');
/**
* 
*/
class Post extends Application
{
	private static $table = 'posts';
	private static $key = array('id');
	private static $lookup = array();
	private static $columns = array(
		'topic',
		'post',
		'changed'
	);

	public static function printAllPosts() {
		$data = Application::index(self::$table);
		$data = Application::fetch_assoc($data);
		foreach ($data as $key => $post) {
			echo 
				'<div class="post_wrapper" id="' . $post['id'] . '">',
				'<p><a href="show.php?id=' . $post['id'] . '"><strong class="topic">' . $post['topic'] . '</strong></a>',
				'<em class="posted">' . $post['changed'] . '</em></p>',
				'<p class="post">' . $post['post'] . '</p>',
				'</div>';
		}
	}

	public static function printSinglePost($lookup, $additional_keys = array()) {
		if ($additional_keys) {
			self::$key = array_merge(self::$key, $additonal_keys);
		}
		if (is_array($lookup)) {
			foreach ($lookup as $key => $value) {
				self::$lookup[] = Application::clean($value);
			}
		}
		else {
			self::$lookup[] = Application::clean($lookup);
		}
		$data = Application::single(self::$table, self::$key, self::$lookup);
		$data = Application::fetch_assoc($data);
		foreach ($data as $key => $post) {
			echo 
				'<div class="post_wrapper" id="' . $post['id'] . '">',
				'<p><strong class="topic">' . $post['topic'] . '</strong>',
				'<em class="posted">' . $post['changed'] . '</em></p>',
				'<p class="post">' . $post['post'] . '</p>',
				'</div>';
		}
	}

	public static function createNewPost($request) {
		Application::create(self::$table, self::$columns, $request);
	}

	public static function updateSinglePost($request) {
		self::$lookup = $request['id'];
		Application::update(self::$table, self::$key, self::$lookup, self::$columns, $request);
	}

	public static function deleteSinglePost($request) {
		self::$lookup = $request['id'];
		Application::delete(self::$table, self::$columns, self::$lookup);
	}
}


?>
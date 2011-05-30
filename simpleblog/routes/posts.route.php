<?php
require_once(dirname(__FILE__) . '/../classes/user.class.php');
require_once(dirname(__FILE__) . '/../classes/posts.class.php');
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
	Post::printSinglePost($_REQUEST['id']);
}
else if (isset($_REQUEST['action'])
		&& isset($_SESSION['is_admin'])
		&& $_REQUEST['action'] == "new"
		&& $_SESSION['is_admin'] === true) {
	Post::createNewPost($_REQUEST);
}
else if (isset($_REQUEST['action'])
		&& isset($_REQUEST['id'])
		&& isset($_SESSION['is_admin'])
		&& $_REQUEST['action'] == "delete"
		&& is_numeric($_REQUEST['id'])
		&& $_SESSION['is_admin'] === true) {
	Post::deleteSinglePost($_REQUEST['id']);
}
else {
	Post::printAllPosts();
}
?>
<?php

require('../classes/Users.php');
$usr = new Users();

echo json_encode($usr->getUserNameById($_GET['id']));

?>
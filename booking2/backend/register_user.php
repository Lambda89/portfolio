<?php

require(dirname(__FILE__).'/../classes/Users.php');

$result = Users::register($_POST);

echo $result;

?>
<?php

require(dirname(__FILE__).'/../classes/Users.php');

$result = Users::login($_POST);

echo $result;

?>
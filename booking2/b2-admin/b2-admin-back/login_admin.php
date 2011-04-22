<?php

require(dirname(__FILE__).'/../../classes/Admin.php');

$result = Admin::login($_POST);

echo $result;

?>
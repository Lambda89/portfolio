<?php

session_start();

$_SESSION['lang'] = $_GET['language'];

header('Location: '.$_GET['return_url']);

?>
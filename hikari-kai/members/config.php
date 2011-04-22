<?php
	mysql_connect("localhost", "hk", "PMxej5rjr45zRjJJ");
	mysql_select_db("hk_site02");

	include("Members.php");
	mysql_query("SET NAMES 'utf8';");
	echo mysql_error();
	header('Content-type: text/html; charset=UTF-8') ;
?>
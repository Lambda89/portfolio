<?php

if ($_GET['fetch'] == "ajax") {
	include(dirname(__FILE__).'/../classes/Application.php');
}

/**
* 
*/
class GetSiteText extends Application
{
	
	function __construct()
	{
		$key = parent::escape($_GET['key'], "sql");
						
		$text = parent::query("SELECT *
			 				   	FROM `site_texts`
							   	WHERE `key` = '$key'
								LIMIT 1"
							);
		
		if (is_array($text)) {
			echo utf8_encode(nl2br(str_replace("[", "<", str_replace("]", ">", $text[0]['text']))));
		} 
		else {
			echo $text;
		}
	}
	
}

new GetSiteText();

?>
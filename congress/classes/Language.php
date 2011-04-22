<?php

/**
* 
*/
class Language
{
	public $languages = array('en-uk', 'en-us', 'sv-se');
	
	function l($key, $relative = false)
	{
		if ($relative == true) {
			include('../lang/'.$_SESSION['lang'].'.php');
		} else {
			include('lang/'.$_SESSION['lang'].'.php');
		}
		
		return $l[$key];
	}
}


?>
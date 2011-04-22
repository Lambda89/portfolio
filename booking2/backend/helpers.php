<?php

$helper_countries = array(
		'dk' => "Danmark", 
		'no' => "Noreg", 
		'se' => "Sverige", 
		'fi' => "Suomi", 
		'uk' => "United Kingdom", 
		'ot' =>"Other"
	);

function __l($string)
{
	session_start();
	
	if ($_SESSION['language'] && $_SESSION['language'] != "swedish") {
		require_once(dirname(__FILE__).'/../lang/'.$_SESSION['language'].'.php');
	}
	
	if ($lang[$string]) {
		echo trim($lang[$string]);
	}
	else {
		echo trim($string);
	}
}

function __la($string)
{
	session_start();
	
	if ($_SESSION['language'] && $_SESSION['language'] != "swedish") {
		require_once(dirname(__FILE__).'/../../lang/'.$_SESSION['language'].'.php');
	}
	
	if ($lang[$string]) {
		echo trim($lang[$string]);
	}
	else {
		echo trim($string);
	}
}

//Luhn-algoritmen i PHP-implementation, saxad från Wikipedia
//Cred till vem som än skrev den

function luhn($ssn)
{
    $sum = 0;
 
    for ($i = 0; $i < strlen($ssn)-1; $i++)
    {
        $tmp = substr($ssn, $i, 1) * (2 - ($i & 1)); //växla mellan 212121212
        if ($tmp > 9) $tmp -= 9;
        $sum += $tmp;
    }
 
    //extrahera en-talet
    $sum = (10 - ($sum % 10)) % 10;
 
    return substr($ssn, -1, 1) == $sum;
}

?>
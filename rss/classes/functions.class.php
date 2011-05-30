<?php

/**
* 
*/
class Functions
{
	// Subarray-sorting function
	// Implementation by Adam S, as documented on http://firsttube.com/read/sorting-a-multi-dimensional-array-with-php/
	// One changed made: arsort() instead or asort(), because we want the dates descending not ascending

	protected static function subval_sort($a,$subkey) {
		foreach($a as $k=>$v) {
			$b[$k] = $v[$subkey];
		}
		arsort($b);
		foreach($b as $key=>$val) {
			$c[] = $a[$key];
		}
		return $c;
	}

	// Makes all dates the same, and therefor sortable

	protected static function standardize_date($date) {
		$date = new DateTime($date);
		$date = $date->format('Y-m-d H:i:s');
		return $date;
	}
}


?>
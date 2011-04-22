<?php

/**
* 
*/
class TestHelpers
{
	public function cleanTable($table)
	{
		mysql_query("TRUNCATE TABLE `".$table."`");
	}
	
	public function insertUser()
	{
		mysql_query("INSERT INTO `users` (`username`, `password`, `email`) VALUES('rickard', 'eb68074d7a37e0ccc59fd8d8b8ff2bb0eed1481f3b5529d30ac3c47e0b72f72b9538bc1e2002423dc94349ddda0ef6cf4f68484911b3139260001e67c3f4319b', 'rickard@oribium.net')");
	}
}


?>
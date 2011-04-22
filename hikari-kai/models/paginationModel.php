<?php

if (stristr($_SERVER['REQUEST_URI'], "model")) {
	header('Location: ../index.php');
	die();
}

class PaginationModel
{
	
	private $page = 1;
	
	function __construct()
	{
		$this->page = $page;
	}
	
	public function pageQuery($SQL)
	{
		return mysql_query($SQL);
	}
	
	public function pageFetch($result)
	{
		return mysql_fetch_assoc($result);
	}
	
	public function pageClean($string)
	{
		if (is_numeric($string)) {
			return $string;
		} else {
			return mysql_real_escape_string($string);
		}
	}
	
	
	public function nextPage($table, $limit)
	{
		$action = $this->pageClean($_GET['action']);
		$id = $this->pageClean($_GET['id']);
		
		if (is_numeric($id)) {
			if ($action == "next") {
				
				$query = "SELECT * FROM `$table` WHERE `id` <= '$id' ORDER BY `id` DESC LIMIT ".$limit;
				$result = $this->pageQuery($query);
				while ($row = $this->pageFetch($result)) {
					echo '
						<div class="post">
							<h3 class="topic">'.$row['topic'].'</h3>
							<p class="this_post"><em>'.stripslashes(nl2br($row['post'])).'</em></p>
							<div class="bottom_line"> </div>
							<p class="poster">Skrivet av: <em>'.$row['author'].'</em></p>';
								if ($_SESSION['is_admin'] === true) {
									echo '
										<div class="bottom_line"> </div>
										<a class="delete" alt="Delete" href="index.php?action=delete&id='.$row['id'].'"> X </a>
									';
								}
						echo '
							</div>
						';
					$next[] = $row['id'];
				}
				$pageLinks = '<p id="page_links"><a href="index.php"> Tillbaka till start </a>';
				if (count($next) > 4) {
					$pageLinks .= '- <a href="index.php?action=next&id='.end($next).'"> Äldre inlägg >> </a>';
				}
				$pageLinks .= '</p>';
				echo $pageLinks;
			}
		}
	}
	
}


?>
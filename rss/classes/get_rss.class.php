<?php

require('functions.class.php');

/**
* Main class to fetch rss.
*/
class GetRss extends Functions
{
	public $urls = array();
	public $sort = '';
	public $output = '';
	public $items = array();
	
	function __construct()
	{
		// Set properties
		$this->urls = ($_REQUEST['urls']) ? $_REQUEST['urls'] : array();
		$this->sort = ($_REQUEST['sort']) ? $_REQUEST['sort'] : 'source';
		$this->output = ($_REQUEST['output']) ? $_REQUEST['output'] : 'html'; 

		$this->getFeeds();

		// If sort by dates is requested, then do so
		if ($this->sort == "date") {
			$this->items = self::subval_sort($this->items, $this->sort);
		}
		
		// Output
		if ($this->output == "html") {
			$this->outputAsHtml();
		}
		if ($this->output == "plain") {
			$this->outputAsPlainText();
		}
	}
	
	private function getFeeds()
	{
		$dom = new DOMDocument();
		$items = array();
		// Load all urls
		foreach ($this->urls as $url) {			
			$dom->load($url);
			foreach ($dom->getElementsByTagName('item') as $node) {
				$itemRSS = array( 
				      'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				      'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
				      'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				      'date' => self::standardize_date($node->getElementsByTagName('pubDate')->item(0)->nodeValue)
				);
				// Push items from loaded url into items
				array_push($items, $itemRSS);
			}
		}
		$this->items = $items;
	}

	// HTML-output function
	
	private function outputAsHtml() {
		foreach ($this->items as $item) {
			echo 
				'<p><strong><a target="_blank" href="' . $item['link'] . '">' . $item['title'] . '</a></strong>',
				'&nbsp<em>' . $item['date'] . '</em><br />',
			 	$item['desc'] . '<br /></p>';
		}
	}

	// Plain-text output function

	private function outputAsPlainText() {
		foreach ($this->items as $item) {
			echo 
				$item['title'] . ' ' . $item['date'] . ' ' . $item['desc'] . ' ' . $item['link'];
		}
	}

	// Example of possible XML-output

	private function outputAsXML() {
		foreach ($this->items as $item) {
			echo 
				'<title>' . $item['title'] . '</title>',
				'<date>' . $item['date'] . '</date>',
				'<description>' . $item['desc'] . '</description>',
				'<link>' . $item['link'] . '</link>';
		}
	}
}




?>
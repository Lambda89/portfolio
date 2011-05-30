<?php

if (isset($_REQUEST['output']) && $_REQUEST['output'] == "html") {
	$html_selected = 'selected="selected"';
}
elseif (isset($_REQUEST['output']) && $_REQUEST['output'] == "plain") {
	$plain_selected = 'selected="selected"';
}
else {
	$html_selected = 'selected="selected"';
}

if (isset($_REQUEST['sort']) && $_REQUEST['sort'] == "source") {
	$source_selected = 'selected="selected"';
}
elseif (isset($_REQUEST['sort']) && $_REQUEST['sort'] == "date") {
	$date_selected = 'selected="selected"';
}
else {
	$source_selected = 'selected="selected"';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="rss.css" type="text/css" media="screen" charset="utf-8" />
	<title><?php echo $_SERVER['PHP_SELF']; ?></title>
	
</head>

<body>	
<div id="feed">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
		<input type="checkbox" name="urls[0]" value="http://www.aftonbladet.se/rss.xml" class="urls">
		<label for="urls[0]"> Aftonbladet </label>
		<input type="checkbox" name="urls[1]" value="http://www.dn.se/nyheter/m/rss/senaste-nytt" class="urls">
		<label for="urls[1]"> Dagens Nyheter </label>
		<hr />
		<select name="output" id="output">
			<option <?php echo $html_selected; ?> value="html">HTML</option>
			<option <?php echo $plain_selected; ?> value="plain">Plain Text</option>
		</select>
		<select name="sort" id="sort">
			<option <?php echo $source_selected; ?> value="source">Source</option>
			<option <?php echo $date_selected; ?> value="date">Date</option>

		</select>
		<input type="submit" value="Get feeds">
	</form>
	<hr />
	<?php
	require('classes/get_rss.class.php');
	new GetRss($_REQUEST);
	?>
</div>

</body>
</html>

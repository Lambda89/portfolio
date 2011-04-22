<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<link rel="stylesheet" href="index.css" type="text/css" media="screen" title="index" charset="utf-8" />
	
	<script type="text/javascript" charset="utf-8" src="jquery.js"> </script>
	<script type="text/javascript" charset="utf-8" src="javascript.js"> </script>

	<title> Workshop </title>
	
</head>

<body>
	<?php
		$texts = array(
			1 => 'Left from my balcony',
			2 => 'Forward from my balcony', 
			3 => 'Right from my balcony'
		);
	?>
	<div id="wrapper">
		<?php for ($i=1; $i < 4; $i++) { ?>
		<div class="card" id="c<?php echo $i ?>">
			<img src="image<?php echo $i ?>.jpg" width="300" height="300px" /> <?php echo $texts[$i]; ?>
		</div>
		<?php } ?>
	</div>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	
	<!--Metadata-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Hikari-Kai Web-Team, Andreas.Fransson , Rickard Lund , Henrik Hugo" />
	<meta name="description" content="Hikari-Kai Website" />
	<meta name="keywords" content="Hikari-Kai,blog,föreningsaktivitet,japan,anime,manga,spel,japanförening,Göteborg" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<!-- Stylesheets and Icons -->
	<link rel="icon" type="image/x-ico" href="uiscripts/hikari-kai-icon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="uiscripts/hikari-kai-icon.ico" />
	<link rel="stylesheet" href="uiscripts/hikari3.css" type="text/css" media="screen" charset="utf-8" />
	
	<!-- JavaScripts -->
	<script type="text/javascript" charset="utf-8" src="uiscripts/jquery.js"> </script>
	<script type="text/javascript" charset="utf-8" src="uiscripts/hikari3.js"> </script>

	<?php
	
		if (stristr($_SERVER['REQUEST_URI'], 'events')) {
			$title = " - Event";
		} else if (stristr($_SERVER['REQUEST_URI'], 'inbox')) {
			$title = " - Förslagslådan";
		} else if (stristr($_SERVER['REQUEST_URI'], 'documents')) {
			$title = " - Dokument";
		} else if (stristr($_SERVER['REQUEST_URI'], 'evenings')) {
			$title = " - Kvällar";
		} else if (stristr($_SERVER['REQUEST_URI'], 'contacts')) {
			$title = " - Kontakt";
		} else if (stristr($_SERVER['REQUEST_URI'], 'about')) {
			$title = " - Information";
		} else if (stristr($_SERVER['REQUEST_URI'], 'comments')) {
			$title = "ett inlägg";
		}
	
	?>

	<title> Hikari-Kai 3.0 <?php echo $title; ?></title>
	<meta property="og:title" content="<?php if ($title != '') {
		echo $title;
	} else {
		echo "Bloggen";
	} ?>" />
	

</head>

<body>

<div id="wrapper">

<?php

	if ($_SESSION['is_admin'] === true) {
		require_once('adminBack.php');
		require_once('admin.php');
	}

?>

<div id="header">
	
	<ul class="menu"> 
		<li class="toplink" id="society"> <a href="#"> Om HK </a> </li>
		<li class="society" id="documents"> <a href="documents.php"> Dokument </a> </li>
		<li class="society" id="evenings"> <a href="evenings.php"> Kvällar </a> </li>
		<li class="society" id="contacts"> <a href="contacts.php"> Kontakt </a> </li>
		<li class="society" id="about"> <a href="about.php"> Info </a> </li>
	  	<li class="society" id="wiki"> <a href="hikawiki/"> Wiki </a> </li>
	</ul>
	
	<ul class="menu"> 
		<li class="toplink" id="main"> <a href="#"> Aktivitet </a> </li>
		<li class="main" id="blog"> <a href="index.php"> Blogg </a> </li>
		<li class="main" id="events"> <a href="events.php"> Event </a> </li>
		<li class="main" id="suggestions"> <a href="inbox.php"> Förslag </a> </li>
		<li class="main" id="subscriptions"> <a href="subscriptions.php"> Följ </a> </li>
		<li class="main" id="hc"> <a href="http://www.hikari-con.se"> Konvent </a> </li>
		<li class="main" id="fb"> <a href="http://www.facebook.com/profile.php?id=100000647106601#!/group.php?gid=17743249848&amp;ref=ts"> Facebook </a> </li>
	</ul>
	
	<div id="like">

		<?php

		echo '<iframe src="http://www.facebook.com/widgets/like.php?href=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'"
		        scrolling="no" frameborder="0"
		        style="border:none; width:450px; height:80px"></iframe>';

		?>

		</div>
	
</div>

<?php
//die{);
include("config.php");
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Kick banned, you ain\'t admin. God did just now kill a kitten';
    exit;
} else {
        if ($_SERVER['PHP_AUTH_PW']=="boxxymudkip")
                echo "";
        else
                die("FUCKED!");
}
?>

<html>
<head>
<meta http-equiv="Content-type" value="text/html; charset=UTF-8">
<script type="text/javascript">
function checkPersonNummer()
{
	var konM = document.getElementById('konM');
	var konK = document.getElementById('konK');
	var input = document.getElementById('pnr');
	var error = document.getElementById('error');
	var nummer = input.value;
	
	if(nummer.length != 11)
	{
		input.style.backgroundColor='#FF0000'
		error.innerHTML = "Fel längd";
		return false;
	}
	if(/[0-9]{6}(\+|-){1}[0-9]{4}/.test(nummer) == false)
	{
		input.style.backgroundColor='#FF0000'
		error.innerHTML = "Fel format";
		return false;
	}
	if((parseInt(nummer.charAt(9)) % 2 != 0 && konK.checked) || (parseInt(nummer.charAt(9)) % 2 == 0 && konM.checked))
	{
		input.style.backgroundColor='#FF0000';
		error.innerHTML = "Fel kön";
		return false;
	}	// Räkna fram kontrollsumman

	var checksum = 0;

	for(var i = 0; i <= 5; i++)
	{
		var n = parseInt(nummer.charAt(i));
		if(i % 2 != 0){
			checksum += n;
		} else {
			checksum += (n*2)%9+Math.floor(n/9)*9;
		}
	}
	for(var i = 7; i <= 9; i++)
	{
		n = parseInt(nummer.charAt(i));
		if(i % 2 == 0){
			checksum += n;
		} else {
			checksum += (n*2)%9+Math.floor(n/9)*9;
		}
	}
	checksum += parseInt(nummer.charAt(10));
	if(checksum % 10 != 0)
	{
		input.style.backgroundColor='#FF0000';
		error.innerHTML = "Fel kontrollsiffra";
		return false;
	}
	
	
	error.innerHTML = "";
	input.style.backgroundColor='#00FF00'
}
</script>
</head>
<body>
<h1>Hikari-kai's Medlemshantering</h1>
<form action="?">
	<input type="text" name="getmember" onfocus="this.value='';" value="Personnummer"/>
	<input type="submit" value="Hämta medlem">
</form>
<?php
	echo "Vi har " . Members::getNumberOfMembers() . " medlemmar i databasen (inklusive sådana som inte är fina och med uppdaterade medlemskap).<br>";
	if(isset($_GET['getmember']))
	{
		$member = Members::getMemberBySSN($_GET['getmember']);
		if(!($member === false))
		{
			echo "<pre>";
			Members::print_simple_edit($member, "?simpleedit=1");
			Members::print_edit($member, "?editmember=1");
			echo "</pre>";
		} else {
			echo "Ingen sådan medlem!";
			echo "<h2>Skapa medlem</h2>";
			Members::print_edit(Array('socialSecurityNumber' => $_GET['getmember']), "?newmember=1");
		}
	}
	if(isset($_GET['simpleedit']))
	{
		Members::do_simple_edit($_POST['id'], $_POST['membershipBegan'],$_POST['membershipEnds'], $_POST['registeredAtEvent']);
	}
	if(isset($_GET['editmember']))
	{
		Members::do_complete_edit($_POST['id'], $_POST[m]);
	}
	if(isset($_GET['newmember']))
	{
		Members::addmember($_POST['m']);
	}
	/*$ans = mysql_query("SELECT * FROM members;");
	while($row = mysql_fetch_assoc($ans))
	{
		echo "<nobr>";
		print_r($row);
		echo "</nobr><br>";
	}*/
?>
</form>
</body>
</html>

<?php
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
function checkPersonNummer($nummer, $gender)
{
	$nummer = trim($nummer); // Detta fixar false positives, när det råkat smyga sig in ett mellanslag på slutet. Ta bort?
	if(strlen($nummer) != 11)
	{
		return "Fel längd!";
	}
	if(preg_match("/[0-9]{6}(\+|-){1}[0-9]{4}/", $nummer) == 0)
	{
		return "Fel format!";
	}
	// Om saken på plats 9 är jämnt delbart med 0 är det en kvinna. Annars en man.
	if(($nummer[9] % 2 != 0 && gender == 'K') || ($nummer[9] % 2 == 0 && gender == 'M'))
	{
		return "Fel kön!";
	}
	
	$checksum = 0;
	
	for($i = 0; $i <= 5; $i++)
	{
		$n = intval($nummer[$i]);
		if($i % 2 != 0){
			$checksum += $n;
		} else {
			$checksum += ($n*2)%9+floor($n/9)*9;
		}
	}
	for($i = 7; $i <= 9; $i++)
	{
		$n = intval($nummer[$i]);
		if($i % 2 == 0){
			$checksum += $n;
		} else {
			$checksum += ($n*2)%9+floor($n/9)*9;
		}
	}
	$checksum += intval($nummer[10]);
	if($checksum % 10 != 0)
	{
		return "Fel kontrollsiffra";
	}
	
	return true;
}

function checkEmail($email)
{
	if(preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $email) == 0)
	{
		return "Felaktig mail!";
	} else {
		return true;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-type" value="text/html; charset=UTF-8">
<body>
<h1>Hikari-kai's Medlemshantering</h1>
<pre>
<table border=1>
<tr><td>Ändra</td><td>PersonID</td><td>socialSecurityNumber</td><td>gender</td><td>firstName</td><td>lastName</td><td>coAddress</td><td>streetAddress</td><td>zipCode</td><td>city</td><td>country</td><td>phoneNr</td><td>altPhoneNr</td><td>eMail</td><td>memberFee</td><td>membershipBegan</td><td>membershipEnds</td><td>registeredAtEvent</td><td>memberSince</td><td>hkMemberID</td></tr>
<?php
	$nooutdated = 0;
	$nofail = 0;
	$ans = mysql_query("SELECT * FROM members;");
	while($row = mysql_fetch_assoc($ans))
	{
		//print_r($row);
		
		if(strtotime("+1 year",strtotime($row['membershipEnds']))  < time())
		{
			$nooutdated++;
			echo "<tr bgcolor='gray'>";
		} else {
			if(strtotime($row['membershipEnds'])  < time())
			{
				$nooutdated++;
				echo "<tr bgcolor='lightblue'>";
			} else {
			echo "<tr>";
			}
		}
		echo "<td><a href='index.php?getmember={$row['socialSecurityNumber']}'>Ändra</a></td>";
		echo "<td>{$row['PersonID']}</td>";
		$check = checkPersonNummer($row['socialSecurityNumber'], $row['gender']);
		if($check !== true)
		{
			$nofail++;
			echo "<td bgcolor='red'>".$check."<br/>";
		} else {
			echo "<td>";
		}
		echo "{$row['socialSecurityNumber']}";
		echo "</td><td>{$row['gender']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['coAddress']}</td><td>{$row['streetAddress']}</td><td>{$row['zipCode']}</td><td>{$row['city']}</td><td>{$row['country']}</td><td>{$row['phoneNr']}</td><td>{$row['altPhoneNr']}</td>";
		$check2 = checkEmail($row['eMail']);
		if($check2 !== true)
		{
			$nofail++;
			echo "<td bgcolor='red'>".$check2."<br/>";
		} else {
			echo "<td>";
		}
		echo "{$row['eMail']}</td><td>{$row['memberFee']}</td><td>{$row['membershipBegan']}</td><td>{$row['membershipEnds']}</td><td>{$row['registeredAtEvent']}</td><td>{$row['memberSince']}</td><td>{$row['hkMemberID']}</td></tr>";
	}
?>
</table>
</pre>
<?php
	echo $nofail . " felaktigheter. " . $nooutdated . "utdaterade medlemmar av " . mysql_num_rows($ans);
?>
</body
</html>

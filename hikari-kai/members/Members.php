<?php
	class Members {
		private function safe($safeit)
		{
			return mysql_real_escape_string($safeit);
		}
		public function getNumberOfMembers() // Hämta hur många medlemmar vi har i databasen
		{
			$ans = mysql_query("SELECT COUNT(*) FROM members;");
			echo mysql_error();
			$row = mysql_fetch_row($ans);
			return $row[0];
		}
		public function getMemberBySSN($SSN) // Hämta en medlem genom dess personnummer.
		{
			$SSN = Members::safe($SSN);
			$ans = mysql_query("SELECT * FROM members WHERE socialSecurityNumber = '$SSN' LIMIT 1;");
			echo mysql_error();
			return mysql_fetch_assoc($ans);
		}
		public function print_edit($member, $actionpoint)
		{
			?>
			
			<form action="<?=$actionpoint;?>" method="POST">
			<pre>
			<label for="m[gender]">Kön:</label> <input type="radio" name="m[gender]" id="konK" value="K"<?=($member['gender'] == 'K' ? " checked" : "");?> onkeyup="checkPersonNummer()" onclick="checkPersonNummer()">(Kvinna)<input type="radio" name="m[gender]" id="konM" value="M"<?=($member['gender'] == 'M' ? " checked" : "");?> onkeyup="checkPersonNummer()" onclick="checkPersonNummer()">(Man)
			<label for="m[firstName]">Förnamn:</label><input type="text" name="m[firstName]" value="<?=$member['firstName'];?>">
			<label for="m[lastName]">Efternamn:</label><input type="text" name="m[lastName]" value="<?=$member['lastName'];?>">
			<label for="m[socialSecurityNumber]">Personnummer:</label><input type="text" name="m[socialSecurityNumber]" onkeyup="checkPersonNummer()" onclick="checkPersonNummer()" id='pnr' value="<?=$member['socialSecurityNumber'];?>"><span id="error"></span>
			<label for="m[streetAddress]">Gatuadress:</label><input type="text" name="m[streetAddress]" value="<?=$member['streetAddress'];?>">
			<label for="m[zipCode]">Postnummer:</label><input type="text" name="m[zipCode]" value="<?=$member['zipCode'];?>">
			<label for="m[city]">Ort:</label><input type="text" name="m[city]" value="<?=$member['city'];?>">
			<label for="m[coAddress]">Ev. C/O adress:</label><input type="text" name="m[coAddress]" value="<?=$member['coAddress'];?>">
			<label for="m[phoneNr]">Tel.nr hem:</label><input type="text" name="m[phoneNr]" value="<?=$member['phoneNr'];?>">
			<label for="m[altPhoneNr]">Mobil/Alt nr:</label><input type="text" name="m[altPhoneNr]" value="<?=$member['altPhoneNr'];?>">
			<label for="m[eMail]">Email:</label><input type="text" name="m[eMail]" value="<?=$member['eMail'];?>">
			<label for="m[membershipBegan]">Ansökningsdatum:</label><input type="text" name="m[membershipBegan]" value="<?=$member['membershipBegan'];?>">
			<label for="m[membershipEnds]">Medlemskap slutar:</label><input type="text" name="m[membershipEnds]" value="<?=$member['membershipEnds'];?>">
			<hr>
			<label for="m[memberFee]">Medlemskostnad:</label><input type="text" name="m[memberFee]" value="<?=$member['memberFee'];?>">
			<label for="m[registredAtEvent]">Registrerades på/av:</label><input type="text" name="m[registeredAtEvent]" value="<?=$member['registeredAtEvent'];?>">
			Medlemsid: <?=$member['PersonID'];?>
			
			Medlem sen: <?=$member['memberSince'];?>
			
			hkMid: <?=$member['hkMemberID'];?>
			<input type="hidden" name="id" value="<?=$member['PersonID'];?>">
			<input type="submit" value="Ändra medlem">
			</pre>
			</form>
			<?php
		}
		
		public function print_simple_edit($member, $actionpoint)
		{
		?>
		<form action="<?=$actionpoint;?>" method="POST">
		<pre>
		<label for="registeredAtEvent">Registrerades på/av:</label><input type="text" name="registeredAtEvent" value="<?=$member['registeredAtEvent'];?>">
		<label for="membershipBegan">Ansökningsdatum:</label><input type="text" name="membershipBegan" value="<?=$member['membershipBegan'];?>">
		<label for="membershipEnds">Slutdatum:</label><input type="text" name="membershipEnds" value="<?=$member['membershipEnds'];?>">
		<input type="hidden" name="id" value="<?=$member['PersonID'];?>">
		<input type="submit" value="Uppdatera">
		</pre>
		</form>
		<?
		}
		
		public function do_simple_edit($id, $membershipBegan, $membershipEnds, $registeredAtEvent)
		{
			$id = Members::safe($id);
			$membershipBegan = Members::safe($membershipBegan);
			$membershipEnds = Members::safe($membershipEnds);
			$registeredAtEvent = Members::safe($registeredAtEvent);
			mysql_query("UPDATE members SET membershipBegan = '$membershipBegan', membershipEnds = '$membershipEnds', registeredAtEvent = '$registeredAtEvent' WHERE PersonID = '$id' LIMIT 1;");
			echo mysql_error();
			echo "Ändrat personen! :D";
		}
		
		public function do_complete_edit($id, $m)
		{
			$id = Members::safe($id);
			echo $id;
			foreach($m as &$var)
			{
				$var = Members::safe($var);
			}
			$sql = "UPDATE members SET
											gender = '{$m[gender]}',
											firstName = '{$m[firstName]}',
											lastName = '{$m[lastName]}',
											socialSecurityNumber = '{$m[socialSecurityNumber]}',
											streetAddress = '{$m[streetAddress]}',
											zipCode = '{$m[zipCode]}',
											city = '{$m[city]}',
											coAddress = '{$m[coAddress]}',
											phoneNr = '{$m[phoneNr]}',
											altPhoneNr = '{$m[altPhoneNr]}',
											eMail = '{$m[eMail]}',
											membershipBegan = '{$m[membershipBegan]}',
											membershipEnds = '{$m[membershipEnds]}',
											memberFee = '{$m[memberFee]}',
											registeredAtEvent = '{$m[registeredAtEvent]}'
											WHERE PersonID = '$id' LIMIT 1
						;";

			mysql_query($sql);
			echo mysql_error();
			echo "Uppdaterade medlemen";
		}
	
		function generatehkmid($id)
		{	
			mt_srand($id); // Seed with the id
			$tries = 0;
			while(true)
			{
				$out = ""; // Initiate the string.
				if(strlen($id) > 4) // If the id is longer thatn 4 characters
				{
					$out .= substr($id, 0, 4); // Then we cut it of at the fourth character
				} else {
					$out .= $id; // Otherwise we just dump it in
				}
				$out .= mt_rand(0, pow(10, 7 - strlen($out)) - 1 ); // Try to generete a number long enough to fill the rest
				while(strlen($out) < 7) // If it wasnt long enough
				{
					$out .= mt_rand(0,9); // Fill the rest of it.
				}

				// Now that the number is generated, check the database for its existance:
				if(mysql_num_rows(mysql_query("SELECT * FROM members WHERE hkMemberID = '$out';")) == 0)
					break;
				if($tries > 9000)
				{
					$out = false;
					break;
				}
				$tries++;
			}
			return $out;
		}
		
		function addmember($m)
		{
			foreach($m as &$var)
			{
				$var = Members::safe($var);
			}
			echo "<pre>";
			print_r($m);
			echo "</pre>";
			$ans = mysql_query("INSERT INTO members (socialSecurityNumber,
											gender,
											firstName,
											lastName,
											coAddress,
											streetAddress,
											zipCode,
											city,
											country,
											phoneNr,
											altPhoneNr,
											eMail,
											memberFee,
											membershipBegan,
											membershipEnds,
											registeredAtEvent,
											memberSince)
											VALUES('{$m[socialSecurityNumber]}',
											'{$m[gender]}',
											'{$m[firstName]}',
											'{$m[lastName]}',
											'{$m[coAddress]}',
											'{$m[streetAddress]}',
											'{$m[zipCode]}',
											'{$m[city]}',
											'Sverige',
											'{$m[phoneNr]}',
											'{$m[altPhoneNr]}',
											'{$m[eMail]}',
											'{$m[memberFee]}',
											'{$m[membershipBegan]}',
											'{$m[membershipEnds]}',
											'{$m[registeredAtEvent]}',
											'{$m[membershipBegan]}');");
			echo mysql_error();
			$id = mysql_insert_id();
			echo $id . "<br>";
			$hkmid = Members::generatehkmid($id);
			echo $hkmid;
			mysql_query("UPDATE members SET hkMemberID = '$hkmid' WHERE PersonID = '$id' LIMIT 1;");
			echo mysql_error();
		}
		
	}
?>
<?php
include("config.php");
 
function membershipEnds($row)
{
 if(strtotime("+1 year",strtotime($row['membershipEnds']))  < time())
                {
                        
                   return false;
                } 
		else
		{
                        if(strtotime($row['membershipEnds'])  < time())
                        {
                                 return false;
                        } 
			
                }
	return true;
}

function checkEmail($email)
{
        if(preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $email) == 0)
        {
                return "Felaktig mail!";
        } 
	else 
	{
                return true;
        }
}







if(isset($_GET['getmember']))
{
                $member = Members::getMemberBySSN($_GET['getmember']);
                if(!($member != false))
                {
                        
			echo "Personen är inte medlem! Hälsa personen välkommen och ge personen en anmälningsblanket.";


                } 
		else 
		{

			if (checkEmail($member['eMail']))
			{
				echo "Personen har en giltlig e-post adress<br>";
			}
			else
			{
				echo "Personen har inte en gilltlig e-post adress<br>";
			}



                 	if(membershipEnds($member))       
                    	{    
				echo "Personen är medlem<br>";
				echo "Personens medlemskap går ut: ". $member['membershipEnds'];
			}
			else
			{
				echo "Personen är medlem med ett utdaterat medlemskap<br>
				Personen måste betala in på nytt för ett medlemskap 50:- <br>";
				echo "Personens medlemskap går ut: ".  $member['membershipEnds'];
			}

		}
}

?>




<form action="?" method="get">
	<input type="text" name="getmember"/>
	<input type="submit" value="Kontrollera medlemskap"/>
</form>


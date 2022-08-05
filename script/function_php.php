<?php
	
function new_line($string)
{
	$i = 0;
	while($i < strlen($string)) 
	{
		if ($string[$i] == '\\')
		{
			$i++;
			if ($i == strlen($string))
				die();
			if ($string[$i] == 'n')
			{
				?><br><?php
			}
			else
				echo $string[$i];	
		}
		else
			echo $string[$i];
		$i++;
		}
}
function message_presentation($string, $date3, $date4, $name)
{
	if ($string == "Envoyés")
	echo "Message envoyés à $name <br> du $date3 au  $date4";
	else if ($string == "Reçus")
	echo "Message Reçus de $name <br> du $date3 au  $date4";
	else
	echo "Message échangés avec $name <br> du $date3 au  $date4";
}
?>
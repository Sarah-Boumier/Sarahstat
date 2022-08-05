<?php

if (($id_string = strval($ligne[$id])) == "")
	$id_string = strval($ligne3[$id]);	
$string = "";
$pos = 0;
if (strpos($texte, $id_string))
{
	$string = "";
	$pos = strpos($texte, $id_string);
	while($texte[$pos] != "\"")
			$pos++;
	$pos++;
	$pos2 = 0;
	while($texte[$pos] != "\"")
		{
			$string[$pos2] = $texte[$pos];
			$pos++;
			$pos2++;
		}
	if (($id_string = strval($ligne[$id])) == "")
		echo ($ligne3[$id] = $string);
	else
	echo ($ligne[$id] = $string);
	
}
?>
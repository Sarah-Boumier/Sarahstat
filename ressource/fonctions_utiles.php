<?php 

function valid_name_file($file, $text)
{
	$index1 = 0;
	$max = strlen($text) - 1;
	while (($file[$index1] == $text[$index1]) && ($index1 < $max))
		$index1++;
	if ($index1 == $max)
		return (0);
	else
		return (1);
}
?>
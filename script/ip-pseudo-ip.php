<?php


include("connexion_base.php");
$pos = 0;
$pos2 = 0;
$req = mysqli_query($conn, "DELETE FROM idpseudohandle");
$n = 0;
while($n < 8841)
{
	$id = 0;
	$pseudo = "";
	$handle = "";
	while($texte[$pos] >= "0" && $texte[$pos] <= "9")
	{
		$id= (int)($texte[$pos]) + $id * 10;
		$pos++;
	}
	$pos = $pos + 3;
	$pos2 = 0;
	$nb = 0;
	while($texte[$pos] != "(" && $nb == 0)
	{
		$pseudo[$pos2] = $texte[$pos];
		$pos2++;
		$pos++;
		if ($pseudo == "Compte qui n existe plus")
			$nb = 1;
	}
	$pos++;
	$pos2 = 0;
	while($texte[$pos] != ")" && $nb == 0)
	{
		$handle[$pos2] = $texte[$pos];
		$pos2++;
		$pos++;
	}
	print_r($n); print_r("--");print_r($id); print_r("--");  print_r($pseudo); print_r("--");  print_r($handle);
	$req = mysqli_query($conn, "INSERT INTO idpseudohandle VALUES ($id,'$pseudo', '$handle')");
	print_r("--"); print_r($req);?><br><?php
	if ($req != 1)
	print_r("c est moi qui est fauté");
	$n = $n + 1;
	$pos = $pos + 3;
}
?>
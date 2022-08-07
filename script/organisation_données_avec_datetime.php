<!DOCTYPE html >
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="twitter.css" />
	<meta charset="utf-8">
</head>
<body >
	<?php
include '../ressource/variable globale.php';	
$localhost = "localhost";
$root = "root";
$conn = new mysqli($localhost, $root, '');
$db_select =  mysqli_select_db($conn, 'twitter');

mysqli_query($conn, "DELETE FROM datadm2");
$url  = 'C:\wamp64\www\Twitter\ressource\direct-messages.js';
$url2 = 'C:\wamp64\www\Twitter\ressource\direct-messages-part1.js';
$page = file_get_contents($url);
$posid1 = 0;
$posid2 = 0;
$posdatetime = 0;
$i = 0;

while ($posid1 = strpos($page, "recipientId", $posid1))
{
	$valueid1 = 0;
	$valueid2 = 0;
	$valueid3 = 0;
	$posid1 = $posid1 + 16;
	$postext = strpos($page, "text", $posid1) + 9;
	$media = strpos($page, "mediaUrls", $postext) + 14;
	$posid2 = strpos($page, "senderId", $postext) +13;
	$id = strpos($page, "id", $posid2) +7;
	$posdatetime = strpos($page, "createdAt", $posid2) + 14;
	
	$datetime = "";
	$mediaurl ="";
	$dt = 0;
	$a = 0;
	$textcontent = "";
	while($page[$posid1] != '"')
	{
		if (!$valueid1 =  ($page[$posid1]) + $valueid1 * 10)
			echo "$i";
		$posid1++;
	}
	while($page[$postext] != '"' || $page[$postext + 1] != ',')
	{
			$textcontent[$a] = $page[$postext];
			$a++;
			$postext++;
	}
	$a = 0;
	while ($page[$media] != ']')
	{
		$mediaurl[$a] = $page[$media];
		$a++;
		$media++;
	}
	while($page[$posid2] != '"')
	{
		$valueid2 =  ($page[$posid2]) + $valueid2 * 10;
		$posid2++;
	}
	while($page[$id] != '"')
	{
		$valueid3 =  ($page[$id]) + $valueid3 * 10;
		$id++;
	}
	while($page[$posdatetime] != '"')
	{
		$datetime[$dt] = $page[$posdatetime];
		$dt++;
		$posdatetime++;
	}
	if ($valueid1 == $personal_id)
		$er = 0;
	else
		$er = 1;
	$minuteoftheday  = (strtotime($datetime) / 60) % 1440;
	$datetime = date('Y-m-d H:i:s', strtotime($datetime)); // convertir mon  2019-06-12T18:07:45.365Z en format valide pour la table mysql de type date
		$textcontent =  mysqli_real_escape_string($conn, $textcontent);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$req =  mysqli_query($conn, "INSERT INTO datadm2  VALUES ($valueid1, $valueid2, '$datetime', $er, '$textcontent', '$mediaurl', $valueid3, $minuteoftheday)");
	if ($req == false)
	{
		print_r("il y a un problème avec la requete");
		die();
	}
	$posid1++;
	$posdatetime++;
	$i++;
}

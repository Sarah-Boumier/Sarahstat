<?php
include '../ressource/variable globale.php';
include '../ressource/fonctions_utiles.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if ($db_select)
$req1 = mysqli_query($conn, "DROP DATABASE twitter");
$req2 = mysqli_query($conn, "CREATE DATABASE twitter DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci;");
$req3 = mysqli_query($conn, "CREATE table datadm2 
(
    id bigint, 
	id2 bigint,
	datetimes datetime,
	er int,
	message text,
	media text,
	id3 text,
	minute int
)");
mysqli_query($conn, "DELETE FROM datadm2");
$posid1 = 0;
$posid2 = 0;
$posdatetime = 0;
$i = 0;
$dir = opendir('C:\wamp64\www\Twitter\ressource');
ini_set('memory_limit', '-1');
 while ($file = readdir($dir))
{
	if (valid_name_file($file, "direct-messages.js") == 0 || valid_name_file($file, "direct-messages-part") == 0)
	{
		$file = "../ressource/" . $file;
		$page = file_get_contents($file);
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
			$schedule_date = new DateTime($datetime, new DateTimeZone('UTC'));
			$schedule_date->setTimeZone(new DateTimeZone('Europe/Paris'));
			$datetime =  $schedule_date->format('Y-m-d H:i:s');
			$minuteoftheday  = (strtotime($datetime) / 60) % 1440;
			$datetime = date('Y-m-d H:i:s', strtotime($datetime));
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
	}
 }

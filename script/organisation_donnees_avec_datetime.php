<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="veuillez_patientez.css">
	<title>Sauvegarde des données en base de données</title>
</head>
<?php
include '../ressource/variable_globale.php';
include '../ressource/fonctions_utiles.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $runQuery = mysqli_query($conn,"SHOW TABLES FROM  $name_db");
      
      $tables = array();
      while($row = mysqli_fetch_array($runQuery))
      {
        $tables[] = $row[0];
      }
      
if(in_array("datadm2", $tables))
{
	$req1 = mysqli_query($conn, "TRUNCATE table datadm2");
}
else
{
	//$db_select =  mysqli_select_db($conn, 'twitter4');
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
}
$posid1 = 0;
$posid2 = 0;
$posdatetime = 0;
$limittime = 120;
$i = 0;
$dir = opendir('../ressource');
ini_set('memory_limit', '-1');
$nombre_de_msg = 0;
$nb_element = 0;
     while ($file = readdir($dir))
	{
		if (valid_name_file($file, "direct-messages.js") == 0 || valid_name_file($file, "direct-messages-part") == 0)
		{
			$file = file_get_contents('../ressource/'.$file);
			$file = substr($file, 35);
	    		$file = json_decode($file);
	    		$i = 0;
	    		while (isset($file[$i]))
	    		{
		 	   	$tableau = $file[$i];
		  	     	$j =0;
		   	    	while (isset($tableau->dmConversation->messages[$j]))
		       	{
		       		$j++;
		       		$nb_element++;
		       	}
		       	 $i++;
   			 }
   		}
   	}
   	closedir($dir);
   	?>
 <body style="background: #00CCCB;" zoom="250%">
<div class="formulaire"><h1 class="titre1">Programme d'installation Sarahstat</h1>
<div id="container" class="container">
<div class="bluebar"><font class="programname">Sarahstat 1.0</font></div>
<div id="imagetext" class="imagetext">
<div id="image" class="image"><img src="../image/db.png" width="50px" height="50px"></div>
<div class="content">
<font id="etape" class="textimportant">Étape 2/4</font>
<div id="textesecondaire" class="seconde">
<font id="description" class="text1">Récupération des messages et stockage en base de données...</font>
<div id="barettexte" class="barettexte">
<progress id="progressbar1" class="bar" value="<?php echo $nombre_de_msg; ?>" max="<?php echo $nb_element; ?>" ></progress>
<font id="message1" class="text1" >Nombre de message récupérés : 0</font></div>
<font id="success" class="text1" style="display: none;" >Tous les messages ont été récupérés !</font></div></div></div>
</div></div>
<?php
$dir = opendir('../ressource');
 while ($file = readdir($dir))
{
	if (valid_name_file($file, "direct-messages.js") == 0 || valid_name_file($file, "direct-messages-part") == 0)
	{
		$file = "../ressource/" . $file;
		$page = file_get_contents($file);
		$x = 0;
		if ($x == 0)
			{
				$posx = strpos($page, "conversationId", 0) + 19;
				$personal_id = 0;
				while ($page[$posx] != '-')
				{
					$personal_id = $page[$posx] +  $personal_id * 10; 
					$posx++;
				}
				fopen('../ressource/variable_globale.php', 'a+');
				$ligne = "$". "personal_id =  \"$personal_id\";\n";
				file_put_contents('../ressource/variable_globale.php', $ligne, FILE_APPEND);
				$x++;
			}
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
			if ($nombre_de_msg % 100000 == 0)
			{
				$limittime = $limittime + 90;
				set_time_limit($limittime);
			}
			?><script >
				User_infos();
				function User_infos()
				{
					var a = <?php echo json_encode($nombre_de_msg); ?>;
					var bar = document.querySelector('#progressbar1');
					bar.value = a;
					var text2 = document.querySelector('#message1');
					text2.innerHTML = "Nombre de message récupérés : " + a;
				}
			</script>
			<?php
			ob_flush();
			flush();
			ob_flush();
			$nombre_de_msg++;
		}
	}
 }
 ?><script >
User_infos();
function User_infos()
{
	var text2 = document.querySelector('#success');
	text2.innerHTML = "Tous les messages ont été récupérés !";
}
</script>
<?php
usleep(2500000);
?>
<script >
all_delete();
function all_delete()
{
	var window = document.querySelector('#container');
	window.style.display = "none";
}
</script>
<?php
include 'id-to-name.php';
?>
</body>
</html>

<!DOCTYPE html>
<html >
<head>
	<link rel="stylesheet" type="text/css" href="discussion.css">
	<title>discussion</title>
	<meta charset="UTF-8">
	<script src="https://twemoji.maxcdn.com/v/latest/twemoji.min.js" crossorigin="anonymous"></script>
</head>
<body   background="../image/background.png">
	<h1 class="h1n1"><a href="../page principale.php" style="margin: auto">Sarahstat</a></h1>
	
<?php
	include '../ressource/variable globale.php';
	require "twitteroauth/autoload.php";
	require "ca-bundle/src/CABUndle.php";
	use Abraham\TwitterOAuth\TwitterOauth;
	
	$nbimg = 1;
	$time_start = microtime(true);
	$date1 = $_GET['date1'];
	$date2 = $_GET['date2'];
 	$id    = $_GET['id'];
	$string =  $_GET['string'];		
	$API_KEY = "";
	$API_KEY_SECRET = "";
	$ACCESS_TOKEN = "";
	$ACCESS_TOKEN_SECRET = "";
	$connexion = new TwitterOauth($API_KEY, $API_KEY_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
	$content = $connexion->get("account/verify_credentials");
	$username = $connexion->get('statuses/user_timeline', ['id' =>$id, 'exclude_replies' => true, 'count' => 1]);
	if (!empty($username))
	{
			if (isset($username->error))
					$image = "http://pbs.twimg.com/profile_images/1453393797073842179/23OQI5fp_normal.jpg";
			else if (isset($username->errors))
					$image = "http://pbs.twimg.com/profile_images/1453393797073842179/23OQI5fp_normal.jpg";
			else 
				$image = $username[0]->user->profile_image_url;
	}
			if (empty($username))
					$image = "http://pbs.twimg.com/profile_images/1453393797073842179/23OQI5fp_normal.jpg";

	setlocale(LC_TIME, "FRENCH");
$date3 = utf8_encode(strftime("%A %d %B %G  %H:%M:%S", strtotime($date1)));
$date4 = utf8_encode(strftime("%A %d %B %G  %H:%M:%S", strtotime($date2)));

?><div class="msgpresentation"><?php message_presentation($_GET['ert'], $date3, $date4, $string);?></div>
	
<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if ($_GET['ert'] == 'Envoyés')
		$req1 = mysqli_query($conn, "SELECT id2,id3,media, message,datetimes FROM datadm2 where datetimes BETWEEN '$date1' AND '$date2' AND id = $id ORDER BY datetimes ASC ");
	else if ($_GET['ert'] == 'Reçus')
		$req1 = mysqli_query($conn, "SELECT id2,id3,media,message,datetimes FROM datadm2 where datetimes BETWEEN '$date1' AND '$date2' AND id2 = $id ORDER BY datetimes ASC ");
	else// ($_GET['ert'] == 'Totaux')
	{
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$req1 = mysqli_query($conn, "SELECT id,id2,id3,media, message,datetimes FROM datadm2 where id = $id AND  datetimes BETWEEN '$date1' AND '$date2' OR id2 = $id AND datetimes BETWEEN '$date1' AND '$date2' ORDER BY datetimes ASC");
	$nbline = mysqli_num_rows($req1);
	}
	$index2 = 0;
	$i = 0;
	while ($ligne = mysqli_fetch_array($req1))
	{
		$date = date_create($ligne['datetimes']);
		setlocale(LC_TIME, "FRENCH");
		$date1 = utf8_encode(strftime("%A %d %B %G  %H:%M:%S", strtotime($ligne['datetimes']))); 
		if ($ligne['id2'] == $personal_id)
		{
			?>
			<div class="div4elements">
			<div class="photo"><img style="border-radius: 3px; object-fit: contain;" src="$link_pdp" ></div>
			<div class="div3elements" id="div3el">
			<div class="name"><?php echo $me;?></div>
			<?php
			if ($ligne['media'] != " ")
				include('type_media.php');
			?>
			<?php			
				if ($ligne['message'] != " ")
				{ 
					$ligne['message'] = kodex_create_links($ligne['message']);
					?>
					<div class="bulltext"><?php new_line($ligne['message']); ?></div><?php
				}?>
			<div class="date" ><?php echo $date1; ?></div></div></div>
			<?php
		}
		else
		{
			?>
			<div class="div4elements">
			<div class="photo"><img src="<?php echo $image ?>"style="border-radius: 3px; object-fit: contain;"></div>
			<div class="div3elementsb">
			<div class="name"><?php echo $string;?></div>
			<?php
			if ($ligne['media'] != " ")
			include('type_media.php');
			?>
			<?php
				if ($ligne['message'] != " ")
				{ 
					$ligne['message'] = kodex_create_links($ligne['message']);
					?>
					<div class="bulltextrose"><?php new_line($ligne['message']); ?></div><?php
				}?>
			<div class="date" ><?php echo $date1; ?></div></div></div>
			<?php
		}
		 $index2++;	
	}
	
function kodex_create_links($string)
{
	$string = preg_replace("/(https:\/\/t.co\/[.\w]+)/i", "<a href=\"$1\">$1</a>", $string);
	return $string;
}
function new_line($string)
{
	$i = 0;
	while($i < strlen($string)) 
	{
		if ($string[$i] == '\\')
		{
			$i++;
			if ($i == strlen($string))
			{
				echo "\\";
				return(0);
			}
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
			echo "Message envoyés à $name  du $date3 au  $date4";
	else if ($string == "Reçus")
			echo "Message Reçus de $name  du $date3 au  $date4";
	else
			echo "Message échangés avec $name  du $date3 au  $date4";
}
function delete_guillemet($string)
{
	$i = 0;
	$a = strlen($string);
	$newstring ="";
	$j = 0;
	while ($i < $a) 
	{
		if ($string[$i] != '"')
		$newstring[$j] = $string[$i];
		$i++;
		$j++;
	}
	return $newstring;
}
function link_to_name($name)
{
	$newname = "";
	$i = 1;
	$nbslash = 0;
	$inn = 0;
	while($nbslash < 4)
	{
		if ($name[$i] == '/')
			$nbslash++;
		$i++;
	}
	while ($name[$i] != '/')
	{
		$newname[$inn] = $name[$i];
		$i++;
		$inn++;
	}
	$i++;
	while ($name[$i] != '/')
	$i++;
	$newname[$inn] = '-';
	$inn++;
	$i++;
	while($name[$i] != '"')
	{
		$newname[$inn] = $name[$i];
		$i++;
		$inn++;
	}
	return($newname);
}
function video_to_name($video, $id)
{
	$nb = strlen($id);
	$i = 0;
	$inn = 0;
	$nbslash =0;
	while($nbslash < 5)
	{
		if ($video[$i] == '/')
			$nbslash++;
		$i++;
	}
		$i--;
		$id[$nb] = '-';
		$i++;
		$nb++;
	while ($video[$i] != '"')
	 {
	 	$id[$nb] = $video[$i];
	 	$nb++;
	 	$i++;
	 }
	return ($id);
}
function video_mp4_tag1($string, $id)
{
	$nb_slash = 0;
	$a = 0;
	
	while($nb_slash < 7)
	{
		if ($string[$a] == '/')
			$nb_slash++;
			$a++;
	}
	$nbid = strlen($id);
	$id[$nbid] = '-';
	$nbid++;
	while ($string[$a] != '?')
	{
		$id[$nbid] = $string[$a];
		$nbid++;
		$a++;
	}
	return ($id);
}
$time_end = microtime(true);
 $time = $time_end - $time_start;
?>
</body>
</html>

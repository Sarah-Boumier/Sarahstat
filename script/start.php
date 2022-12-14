<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="veuillez_patientez.css" />
	<title></title>
</head>
<body style="background: #00CCCB;">
<form action="start.php" class="formulaire" method="get">
<h1 class="titre1">Programme d'installation Sarahstat</h1>
<div id="container01" class="container0">
<div class="bluebar"><font class="programname">Sarahstat 1.0</font></div>
<div id="imagetext" class="imagetext">
<div id="image" class="image"><img src="../image/db.png" width="50px" height="50px"></div>
<div class="content">
<font id="etape" class="textimportant">Étape 1/4</font>
<div id="textesecondaire" class="seconde">
<font id="description" class="text1">Saisi des identifiants</font>
<div id="barettexte" class="barettexte">
	<div class="idkey"><div><label for="id" class="label" style="font-size: 8px;">API_KEY</label></div><div class="key"><input type="text" name="id" class="input"><br></div></div>
	<div class="idkey"><div><label for="id2" style="font-size: 8px; margin-left: -31px;">API_KEY_SECRET </label><input type="text" name="id2" class="input"><br></div></div>
	<div class="idkey"><div><label for="id3" style="font-size: 8px; margin-left: -21px;">ACCES_TOKEN </label><input type="text" name="id3" class="input"><br></div></div>
	<div class="idkey"><label for="id4" style="font-size: 8px; margin-left: -53px;">ACCES_TOKEN_SECRET </label><input type="text" name="id4" class="input"><br></div></div>
	<div><div class="bouton"><button  type="submit" id="bouton" class="bouton-vert" onclick="faire_disparaitre(1)">Suivant</button></div></div>
</div>

</div></form>
<?php
include '../ressource/variable_globale.php';
//$conn = new mysqli('localhost', 'root', '');
$req2 = mysqli_query($conn, "CREATE DATABASE $name_db DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci;");
$lines = file('../ressource/variable_globale.php'); 
$last = sizeof($lines) - 1 ;
while ($last > 4)
{ 
	unset($lines[$last]); 
	$fp = fopen('../ressource/variable_globale.php', 'w'); 
	fwrite($fp, implode('', $lines)); 
	fclose($fp);
	$last--;
} 
include '../ressource/variable_globale.php';
$req1 = mysqli_query($conn, "CREATE TABLE infos
(
	api_key text,
	api_key_secret text,
	access_token text,
	access_token_secret text
)");
$req3 = mysqli_query($conn, "TRUNCATE TABLE infos");
require "../ressource/twitteroauth/autoload.php";
require "../ressource/ca-bundle/src/CABUndle.php";
use Abraham\TwitterOAuth\TwitterOauth;
$i = 0;
if ((isset($_GET['id']) && (isset($_GET['id2']) && (isset($_GET['id3']) && (isset($_GET['id4']))))))
{
	$id = $_GET['id'];
	$id2 = $_GET['id2'];
	$id3 = $_GET['id3'];
	$id4 = $_GET['id4'];
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$req2 = mysqli_query($conn, "INSERT INTO infos (api_key, api_key_secret, access_token, access_token_secret) VALUES ('$id', '$id2', '$id3', '$id4')");
	$req3 = mysqli_query($conn, "SELECT api_key, api_key_secret, access_token,access_token_secret FROM infos");
	$ligne = mysqli_fetch_array($req3);
	$connexion = new TwitterOauth($ligne['api_key'], $ligne['api_key_secret'], $ligne['access_token'], $ligne['access_token_secret']);
	$content = $connexion->get("account/verify_credentials");

	if (property_exists($content, "errors"))
	{
		$req3 = mysqli_query($conn, "TRUNCATE TABLE infos");
		header('start.php');
	}
	else
	{
		?>
		<script>
			gopage2();
			function gopage2()
			{
				var a = document.querySelector('#container01');
				a.style.display = 'none';
				 document.location.href="organisation_donnees_avec_datetime.php"; 	
			}
		</script>
			<?php 
	}
}

function retour_a_la_ligne($text)
{
	$i = 0;
	$max = strlen(file_get_contents('test.php')) - 1;
	while ($i < $max)
	{
		if($text[$i] == ';');
		substr_replace(";",";\n",$i);
		$i++;
	}
	return($text);
}
?>
<script type="text/javascript">

function faire_disparaitre($i)
{
	if ($i == 1)
		var a = document.querySelector('#container01');
	a.style.display = "none";	
}
</script>
</body>
</html>

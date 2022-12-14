 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" type="text/css" href="veuillez_patientez.css">
 	<title></title>
 </head>
 <body>
 	<script type="text/javascript">
 		
 	</script>
 	<div class="container" id="titre1">
 		<div class="bluebar"><font class="programname">Sarahstat 1.0</font></div>
		<div id="imagetext" class="imagetext">	
 			<div id="image" class="image"><img src="../image/db.png" width="50px" height="50px"></div>
 			<div id="textd" class="content3">
 				<div id="divetape"><font id="text7" class="textimportant3">Étape 4/4</font></div>
 				<div id="textesecondaire" class="seconde3">
 					<div id="checkbox21" class="checkboxg" style="display: none;">
 						<div id="part1" class="checkbox"><font id="choix1" class="text1">Pour Creer un raccourci sur le bureau lancez raccourci.bat"</font></div>
 						<div id="part2" class="checkbox"><input type="checkbox" id="case2" name="case2"><font id="choix2" class="text1">Lancer Sarahstat</font></div>
 					</div>
 					<div id="infos" class="infos">
 						<font id="description" class="text1">Récupération des données publiques de votre compte twitter</font>
 						<font id="action" class="text1"></font>					
 					</div>
 					<button id="button2" class="btn" onclick="end()" style="display: none;">Terminer</button>
 					<button id="button1" class="btn" >Suivant</button>
 				</div>
 			</div>
 		</div>
	</div>
  <?php
include '../ressource/variable_globale.php';
require "../ressource/twitteroauth/autoload.php";
require_once "../ressource/ca-bundle/src/CABundle.php";
use Abraham\TwitterOAuth\TwitterOauth;
$req1 = mysqli_query($conn, "SELECT t1.id, count(t1.id) FROM ( SELECT id from datadm2 UNION ALL SELECT id2 from datadm2 ) AS t1 GROUP by id ORDER by count(*) DESC");
$info = mysqli_fetch_array($req1);
$id = $info['id'];
?>
<script type="text/javascript">
	get_id();
	function get_id()
	 {
	 	var text = document.querySelector('#action');
	 	text.InnerHTML = "ID de votre compte twitter récupéré";
	 }
</script><?php

$req3 = mysqli_query($conn, "SELECT api_key, api_key_secret, access_token,access_token_secret FROM infos");
$ligne2 = mysqli_fetch_array($req3);
$connexion = new TwitterOauth($ligne2['api_key'], $ligne2['api_key_secret'], $ligne2['access_token'], $ligne2['access_token_secret']);
$content = $connexion->get("account/verify_credentials");
$username = $connexion->get('users/show', ['id' =>$id]);
$image = $username->profile_image_url;
?>
<script type="text/javascript">
	get_pdp();
	function get_pdp()
	 {
	 	var text = document.querySelector('#action');
	 	text.InnerHTML = "lien de votre photo de profil twitter récupéré";
	 }
</script><?php
$name = $username->name;
?>
<script type="text/javascript">
	get_name();
	function get_name()
	 {
	 	var text = document.querySelector('#action');
	 	text.innerHTML = "pseudo twitter récupéré";
	 }
</script><?php
$screen_name = $username->screen_name;
?>
<script type="text/javascript">
	get_screenname();
	function get_screenname()
	 {
	 	var text = document.querySelector('#action');
	 	text.innerHTML = "nom d'affichage twitter récupéré";
	 }
</script><?php
$ligne3 = "$". "link_pdp = \"$image\";\n";

$ligne4 = "$". "me = \"$name(@$screen_name)\";\n";
file_put_contents('../ressource/variable_globale.php', $ligne3, FILE_APPEND);
file_put_contents('../ressource/variable_globale.php', $ligne4, FILE_APPEND); 
?>
<script type="text/javascript">
	get_screenname2();
	function get_screenname2()
	 {

	 	var text7 = document.querySelector('#action');
	 	var description = document.querySelector('#description');	 
	 	description.style.display = "none";
	 	text7.innerHTML = "Récupération des informations terminée !";
	 }
</script>
<script type="text/javascript">
var button = document.querySelector('#button1');
var button2 = document.querySelector('#button2');
	button.addEventListener('click', next);
	button2.addEventListener('click', end());
		
	function next()
	{
		var infos = document.querySelector('#infos');
		var checkbox21 = document.querySelector('#checkbox21');
		var divetape = document.querySelector('#divetape');
		var button1 = document.querySelector('#button1');
		var button2 = document.querySelector('#button2'); 

		infos.style.display = "none";
		checkbox21.style.display = "block";
		divetape.style.display = "none";
		button1.style.display = "none";
		button2.style.display = "block";
	}
	function end()
	{
		if(document.querySelector('#case2').checked == true)
		{
			 document.location.href="../recherche_entre_deux_dates/date_selection.php"; 	
		}
		else
		{
			//var customWindow = window.open('', '_blank', '');
	    	//customWindow.close();
    			window.close();
		}

		//window.close();
	}
</script>
 </body>
 </html>

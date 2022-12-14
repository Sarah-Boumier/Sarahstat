<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="veuillez_patientez.css">
	<title></title>
</head>
<body>
<?php

include '../ressource/variable_globale.php';
file_put_contents('../ressource/bdd2705.txt', '');

$req1 = mysqli_query($conn, "SELECT t1.id, count(t1.id) FROM ( SELECT id from datadm2 where id != '$personal_id' UNION ALL SELECT id2 from datadm2 where id2 != 'personal_id') AS t1 GROUP by id ORDER by count(*) DESC");
$req2 = mysqli_query($conn, " SELECT COUNT(*) FROM (SELECT t1.id, count(t1.id) FROM ( SELECT id from datadm2 where id != $personal_id UNION ALL SELECT id2 from datadm2 where id2 != $personal_id) AS t1 GROUP by id ORDER by count(*) DESC) AS t1");
$req3 = mysqli_query($conn, "SELECT * from infos");
$ligne = mysqli_fetch_array($req2);
$ligne2 = mysqli_fetch_array($req3);
$API_KEY = $ligne2['api_key'];
$API_KEY_SECRET = $ligne2['api_key_secret'];
$ACCESS_TOKEN = $ligne2['access_token'];
$ACCESS_TOKEN_SECRET = $ligne2['access_token_secret'];
$total = $ligne['COUNT(*)'];

	require "../ressource/twitteroauth/autoload.php";
	require "../ressource/ca-bundle/src/CABUndle.php";
	use Abraham\TwitterOAuth\TwitterOauth;
	$connexion = new TwitterOauth($API_KEY, $API_KEY_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
	$content = $connexion->get("account/verify_credentials");
	$file = fopen('../ressource/bdd2705.txt', 'a+');
	$nb_line = 0;
	$limittime = 60;
	$index = 0;
	$time_to_wait = 0;
	$compte_suspendu = 0;
	$compte_supprime = 0;
	$compte_existant = 0;
	$timeA = microtime(true);
	?>
	<div id="container2" class="container2">
		<div class="bluebar"><font class="programname">Sarahstat 1.0</font></div>
		<div id="imagetext" class="imagetext">
			<div id="image" class="image2"><img src="../image/db.png" width="50px" height="50px"></div>
		<div class="content">
  			<font id="text7" class="textimportant">Étape 3/4</font>
  			<div id="textesecondaire" class="seconde">	
  				<font id="description" class="text2">Conversion id/nom twitter</font>
  				<div id="barettexte" class="barettexte">
  					<progress  class="bar" id="progressbar" value="<?php echo $index ; ?>" max="<?php echo $total; ?>" >5%</progress>
  					<font id="text1" style="font-size: 9px;">Nombre de fichier converti : <?php echo $index . '/'. $total ?></font>
  					<div id="information" class="information">
  						<font id="text4" style="font-size: 9px">Nombre de compte existants : <?php echo $compte_existant ?></font>
   						<font id="text5" style="font-size: 9px;">Nombre de compte suspendus : <?php echo $compte_suspendu ?></font>
    					<font id="text6" style="font-size: 9px;">Nombre de compte supprimés : <?php echo $compte_supprime ?></font>
   						<font id="text3" style="font-size: 9px; display: none;">temps d'attendre du aux quotas twitter : <?php echo $time_to_wait ?></font>
   					</div>
   				</div>
   			</div>
   		</div>
   	</div>
   <script type="text/javascript">
   	var window = document.querySelector('#d')
   </script>
  </div><?php
	while ($ligne =  mysqli_fetch_array($req1))
	{
		if ($index % 900 == 0 && $index != 0)
			{
				$time_to_wait = round(900 - (microtime(true) - $timeA), 0, PHP_ROUND_HALF_DOWN);
				while ($time_to_wait > 0)
				{
						?><script type="text/javascript">
							time_to_wait();
							function time_to_wait()
							{
								var text = document.getElementById("text3");
								var time_to_wait =<?php echo json_encode($time_to_wait); ?>; 
								text.innerHTML = "Temps à attendre du aux quotas twitter :" + time_to_wait + "s<br>";
								text.style.display = "block";
							}
						</script><?php
						ob_flush();
						flush();
						ob_flush();
						usleep(1000000);
						$time_to_wait--;
				}
				?><script type="text/javascript">
					deleted();
					function deleted()
					{
						var text = document.getElementById("text3");
						text.innerHTML = "";
					}
				</script>
					<?php
				$timeA = microtime(true);
			}
		$id = $ligne['id'];
		$username = $connexion->get('users/show', ['id' =>$id]);
		if (isset($username->errors[0]->message))
		{
			if ($username->errors[0]->message == 'User has been suspended.')
			{
					$line = $id . "  \"Compte qui a été suspendu\"\n";
					$compte_suspendu++;
			}
			else if ($username->errors[0]->message == 'User not found.')
			{
					$line = $id . "  \"Compte qui a été supprimé\"\n";
					$compte_supprime++;
			}
		}
		else
		{
			$name = $username->name;
			$handle =  $username->screen_name;
			$line = $id . "  \"" . $name . " (@". $handle . ")\"\n";
			$compte_existant++;
		}
		file_put_contents('../ressource/bdd2705.txt', $line, FILE_APPEND);
		if ($nb_line % 100 == 0)
		{
			$limittime = $limittime + 90;
			set_time_limit($limittime);
		}
		?><script> Update()
		function Update()
		{  
			var a = <?php echo json_encode($index); ?>;
			var total = <?php echo json_encode($total); ?>;
			var data1 = <?php echo json_encode($compte_existant); ?>;
			var data2 = <?php echo json_encode($compte_suspendu); ?>;
			var data3 = <?php echo json_encode($compte_supprime); ?>;
			var text = document.querySelector('#text1');
			var text2 = document.querySelector('#text4');
			var text3 = document.querySelector('#text5');
			var text4 = document.querySelector('#text6');
			progressbar = document.getElementById("progressbar");
			progressbar.value = a;
			progressbar.style.background = "purple";
			text.innerHTML = "Nombre d'id convertis : " + a + "/" + total;
			text2.innerHTML = "Nombre de compte existants : " + data1;
			text3.innerHTML = "Nombre de compte suspendus : " + data2;
			text4.innerHTML = "Nombre de compte supprimés : " + data3;

		}
		</script><?php
		ob_flush();
		flush();
		ob_flush();
		$nb_line++;
		$index++;
	}
fclose($file);
	?><script> Update()
function Update()
	{  
		var text2 = document.querySelector('#text2');
		text2.innerHTML = "Chargement fini avec succes !";
	}</script>
	<?php
	usleep(1500000);
	?>
	<script> delete_all()
function delete_all()
	{
			var window2 = document.querySelector('#container2');  
			window2.style.display = "none";
	}
</script>
<?php

include 'infos_utilisateur.php';
?>
</body>
</html>

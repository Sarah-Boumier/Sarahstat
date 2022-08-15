<!DOCTYPE html>
<html>
<head>
	<title>Recherche entre deux dates</title>
	<link rel="stylesheet" type="text/css" href="../ressource/css_responsiv_essais_5.css" />
	<meta charset="utf-8">
</head>
<body background="../image/background.png">
	
	<h1 class="h1n1"><a href="../page principale.php" style="margin: auto">Sarahstat</a></h1>
	<?php
 	$text = '../ressource/bdd2703.txt';
	$texte = file_get_contents($text);

	?>
	<form action="date_selection.php"  method="post" >
		<div class="porte">
			<div  class="label-input">	
				<label for="datetimelocal1" class="date">Date de début &nbsp</label>
				<input id="datetime" type="datetime-local" class="datetime" id="datetimelocal1" name="date" required="required" value="<?php if (isset($_POST['date'])){echo $_POST['date'];} ?>">
			</div>	
			<div class="label-input2">
				<label for="datetimelocal2" class="date">Date de fin &nbsp </label>
				<input type="datetime-local" class="datetime" id="datetimelocal2" name="date2" required="required" value="<?php if (isset($_POST['date2'])){echo $_POST['date2'];} ?>">
			</div>
			<div class="select-bouton">
				<select name="etat" selected="selected">
					<option>Envoyés</option>
					<option>Reçus</option>
					<option>Totaux</option>	
				</select>
				<input  type="submit" id="bouton" class="bouton-vert">
			</div>
		</div>
	</form>
	<?php
		include('affichage tableau.php');
		?>
	
		</body>
</html>

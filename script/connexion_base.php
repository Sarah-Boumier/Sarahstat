<?php

	$localhost = "localhost";
	$root = "root";
	$text = 'C:\wamp64\www\Twitter\ressource\bdd2703.txt';
	$texte = file_get_contents($text);
	$conn = new mysqli($localhost, $root, '');
	$db_select =  mysqli_select_db($conn, 'twitter');


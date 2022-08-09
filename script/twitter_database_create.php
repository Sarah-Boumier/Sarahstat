<?php
$conn = new mysqli('localhost', 'root', '');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo '== Suppression de la base de données... ==';
$conn->query('DROP DATABASE twitter2');

echo '== Recréation de la base de données... ==';
$conn->query("CREATE DATABASE twitter2 DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci;");

echo '== Création de la table twitter2... ==';
$conn->select_db('twitter2');
$conn->query("CREATE table datadm2 
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

?>
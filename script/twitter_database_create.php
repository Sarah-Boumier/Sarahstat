<?php
$conn = new mysqli('localhost', 'root', '');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$req1 = mysqli_query($conn, "DROP DATABASE twitter");
$req2 = mysqli_query($conn, "CREATE DATABASE twitter DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci;");
$db_select =  mysqli_select_db($conn, 'twitter');
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


?>

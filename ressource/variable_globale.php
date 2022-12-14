<?php
	
$conn = new mysqli('localhost', 'root', '');
$name_db = "twitter";
$db_select =  mysqli_select_db($conn, $name_db);

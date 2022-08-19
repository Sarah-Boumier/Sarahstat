<?php
	$personal_id =  ;
	$link_pdp = "";
	$me  = "";
	$API_KEY = "";
	$API_KEY_SECRET = "";
	$ACCESS_TOKEN = "";
	$ACCESS_TOKEN_SECRET = "";
	
	$conn = new mysqli('localhost', 'root', '');
	$db_select =  mysqli_select_db($conn, 'twitter');
	require "twitteroauth/autoload.php";
	require "ca-bundle/src/CABUndle.php";
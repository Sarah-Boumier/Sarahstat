<?php

include '../ressource/variable globale.php';
file_put_contents('../ressource/bdd2703.txt', '');

$req1 = mysqli_query($conn, "SELECT t1.id, count(t1.id) FROM ( SELECT id from datadm2 where id != 'my_id' UNION ALL SELECT id2 from datadm2 where id2 != 'my_id') AS t1 GROUP by id ORDER by count(*) DESC ");

	use Abraham\TwitterOAuth\TwitterOauth;
	$connexion = new TwitterOauth($API_KEY, $API_KEY_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
	$content = $connexion->get("account/verify_credentials");
	$file = fopen('../ressource/bdd2703.txt', 'a+');
	$nb_line = 0;
	$limittime = 60;
	while ($ligne =  mysqli_fetch_array($req1))
	{
		$id = $ligne['id'];
		$username = $connexion->get('statuses/user_timeline', ['id' =>$id, 'exclude_replies' => true, 'count' => 1]);
		if (!empty($username))
		{
			if (isset($username->error))
				$line = $id . "  \"Compte qui a été suspendu ou privé\"\n";
			else if (isset($username->errors))
				$line = $id. "  \"Compte qui n'existe plus\"\n";
			else
			{
				$name = $username[0]->user->name;
				$handle =  $username[0]->user->screen_name;
				$line = $id . "  \"" . $name . " (@". $handle . ")\"\n";
			}
			file_put_contents('../ressource/bdd2703.txt', $line, FILE_APPEND);
			if ($nb_line % 100 == 0)
			{
				$limittime = $limittime + 50;
				set_time_limit($limittime);
			}
		}
		$nb_line++;
	}
fclose($file);
?>
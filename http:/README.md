 prerequis : wamp, python, visual studio code
1 Depuis votre compte twitter, Allez dans "plus" puis "parametres et confidentalité" puis cliquez sur  "Telecharger une archive de vos données" rentrez 
votre mot de passe pour valider la demande cela va prendre environ 24h avant qu'elle soit prête à être telechargée.

2 Créer une base de données qui s'appellera "Twitter" avec une table de données qui s'appellera "datadm2" qui continedra 8 colonnes
  a - la premiere   sera  "id" de type   bigint
  b - la deuxieme  sera  "id2" de type bigint
  c - la troisieme sera "datetimes" de type datetime
  d - la quatrieme sera "er" de type  int
  e - la 5eme sera "message" de type  text
  f - la 6ème sera média de type text
  g - la 7eme sera  "id3" de type text
  h - la 8eme sera "minute" de type  int
  i - l'interclassement de la table  sera  "utf8_general_ci"

3 - Creer un compte twitter developpeur (https://developer.twitter.com/en)  si ce n'est déjà fait puis obtenez et notez bien précieusement: 
 	a - l'API_KEY 
	b - l'API_KEY_SECRET
	c - l'ACCESS_TOKEN
	d - l'ACCESS_TOKEN_SECRET
  
4 - Les reporter dans les lignes 23 à 26 entre les guillemets dans  "recherche_entre_deux_dates/discussion.php"

5 - Dans le dossier ressource :
    a - placer votre dossier "direct_messages_media" de votre archive twitter
    b - placer votre ou vos fichiers qui commencent par "direct-messages"
    
6 -  Executer "script/organisation_données_avec_datetime.php" dans votre navigateur 
	- si vous avez plusieurs fichiers  executez une premiere fois avec la ligne 17  puis pour les autres fichier  il faudra la commenter en mettant le nom exact en 	ligne 19.
	
7 - executer "ressource/id-to-namev4.py" (ça peut prendre du temps si vous parlez à beaucoup de gens^^)

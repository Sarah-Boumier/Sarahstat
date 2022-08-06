# Twitter
Prérequis : Wamp, Python, Visual Studio Code, Google Chrome
 
1. - Depuis votre compte twitter, Allez dans "plus" puis "paramètres et confidentialité" puis cliquez sur  "Télécharger une archive de vos données" rentrez 
votre mot de passe pour valider la demande cela va prendre environ 24h avant qu'elle soit prête à être téléchargée.

2. Créer une base de données qui s'appellera "Twitter" avec une table de données qui s'appellera "datadm2" qui contiendra 8 colonnes

	1. - la  1ère   sera  "id" de type   bigint 
	2. - la  2ème sera  "id2" de type bigint
	3. - la  3ème sera "datetimes" de type datetime
	4. - la 4ème sera "er" de type  int
	5. - la 5ème sera "message" de type  text
	6. - la 6ème sera média de type text
	7. - la 7ème sera  "id3" de type text
	8. - la 8ème sera "minute" de type  int
	9. - l'interclassement de la table  sera  "utf8_general_ci"

3. - Creer un compte twitter developpeur (https://developer.twitter.com/en)  si ce n'est déjà fait puis obtenez et notez bien précieusement: 
	1. - l'API_KEY 
	2. - l'API_KEY_SECRET
	3. - l'ACCESS_TOKEN
	4. - l'ACCESS_TOKEN_SECRET
  
4. - Les reporter dans les lignes 23 à 26 entre les guillemets dans  "recherche_entre_deux_dates/discussion.php"

5. - Dans le dossier ressource :
	1. - placer votre dossier "direct_messages_media" de votre archive twitter
	2. - placer votre ou vos fichiers qui commencent par "direct-messages"
    
6. - Exécuter "script/organisation_données_avec_datetime.php" dans votre navigateur 

	- si vous avez plusieurs fichiers  exécutez une première fois avec la ligne 17  puis pour les autres fichier  il faudra la commenter en mettant le nom exact en 	ligne 19.
	
7. - exécuter "ressource/id-to-namev4.py" (ça peut prendre du temps si vous parlez à beaucoup de gens^^)


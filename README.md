# Twitter
Prérequis : Wamp, Python, Selenium, Google Chrome

1. - Depuis votre compte twitter, Allez dans "plus" puis "paramètres et confidentialité" puis cliquez sur  "Télécharger une archive de vos données" rentrez 
votre mot de passe pour valider la demande cela va prendre environ 24h avant qu'elle soit prête à être téléchargée.
2. - Si ce n'est pas déjà le cas mettez à jour Google Chrome pour avoir la version la plus récente.
3. - Telecharger Chromedriver ayant le même numéro de version que celle de Google Chrome.
4. - Executez "script/twitter_database_create.php"

5. - Creer un compte twitter developpeur (https://developer.twitter.com/en)  si ce n'est déjà fait puis obtenez et notez bien précieusement: 
	1. - L'API_KEY 
	2. - L'API_KEY_SECRET
	3. - L'ACCESS_TOKEN
	4. - L'ACCESS_TOKEN_SECRET
  
6. - Les reporter dans les lignes 23 à 26 entre les guillemets dans  "recherche_entre_deux_dates/discussion.php"

7. - Dans le dossier ressource :
	1. - Placez votre dossier "direct_messages_media" de votre archive twitter
	2. - Placez votre ou vos fichiers qui commencent par "direct-messages"
    
8. - Exécuter "script/organisation_données_avec_datetime.php" dans votre navigateur 

	- Si vous avez plusieurs fichiers exécutez une première fois avec la ligne 17 puis pour les autres fichier  il faudra la commenter en mettant le nom exact en 	ligne 19.
	
9. - Exécuter "ressource/id-to-namev4.py" (ça peut prendre du temps si vous parlez à beaucoup de gens^^)


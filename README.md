# Twitter
Prérequis : Wamp, Python, Selenium, Google Chrome, pip pour python

1. - Depuis votre compte twitter, Allez dans "plus" puis "paramètres et confidentialité" puis cliquez sur  "Télécharger une archive de vos données" rentrez 
votre mot de passe pour valider la demande cela va prendre environ 24h avant qu'elle soit prête à être téléchargée.
2. - Dans : wamp64/www creez un dossier "Twitter" puis placer le contenu de ce projet dedans
3. - Si ce n'est pas déjà le cas mettez à jour Google Chrome pour avoir la version la plus récente.
4. - Telecharger Chromedriver ayant le même numéro de version que celle de Google Chrome puis placez le dans le dossier script.
5. - Executez "script/twitter_database_create.php"

6. - Creer un compte twitter developpeur (https://developer.twitter.com/en)  si ce n'est déjà fait puis obtenez et notez bien précieusement: 
	1. - L'API_KEY 
	2. - L'API_KEY_SECRET
	3. - L'ACCESS_TOKEN
	4. - L'ACCESS_TOKEN_SECRET
  
7. - Les reporter dans les lignes 23 à 26 entre les guillemets dans  "recherche_entre_deux_dates/discussion.php"

8. - Dans le fichier "ressource/variable globale.php" renseignez :
	1. - $personal_id (l'id de votre compte twitter)
	2. - $link_pdp (le lien de votre photo de profil twitter) : 
		1. allez sur votre profil 
		2. cliquez sur votre photo de profil
		3. faites un clique droit et selectionner copier l'adresse du lien
		4. coller le tout entre les guillemets 
		5. changez la partie "400*400" en  "normal"
	3. - $me (votre pseudo suivi d'une parenthese ouvrante suivi  d'un "@" suivi de votre handle suivi d'une parenthese fermante)
9. - Dans le dossier ressource :
	1. - Placez votre dossier "direct_messages_media" de votre archive twitter
	2. - Placez votre ou vos fichiers qui commencent par "direct-messages.js" ou "direct-messages-part"
    
10. - Exécuter "script/organisation_données_avec_datetime.php" dans votre navigateur 

	- Si vous avez plusieurs fichiers exécutez une première fois avec la ligne 17 puis pour les autres fichiers  il faudra la commenter en mettant le nom exact en 	ligne 19 puis rajoutez un "2" à la ligne 20.
	- avant : 
	- $page = file_get_contents($url);
	- après : 
	- $page = file_get_contents($url2);
11. - Dans "script/id-to-namev4.py" renseignez votre id en ligne 9 
12. - Exécuter "script/id-to-namev4.py" (ça peut prendre du temps si vous parlez à beaucoup de gens^^

13. - Enfin  Executez recherche_entre_deux_dates/date_selection.php et voilà !

# Twitter
Prérequis : Wamp, Google Chrome,  Windows

1. - Depuis votre compte twitter, Allez dans "plus" puis "paramètres et confidentialité" puis cliquez sur  "Télécharger une archive de vos données" rentrez 
votre mot de passe pour valider la demande cela va prendre environ 24h avant qu'elle soit prête à être téléchargée.
2. - Dans : wamp64/www creez un dossier "Twitter" puis placez le contenu de ce projet dedans
3. - Creer un compte twitter developpeur (https://developer.twitter.com/en)  si ce n'est déjà fait
4 . Creer une application puis obtenez et notez bien precieusement
	1. - L'API_KEY 
	2. - L'API_KEY_SECRET
	3. - L'ACCESS_TOKEN
	4. - L'ACCESS_TOKEN_SECRET
  
5. - Les reporter dans les lignes 5 à 8 entre les guillemets dans  "ressource/variable_globale.php"
6. - Dans le fichier "ressource/variable_globale.php" renseignez :
	1. - $personal_id (l'id de votre compte twitter)
	2. - $link_pdp (le lien de votre photo de profil twitter) : 
		1. Allez sur votre profil 
		2. Cliquez sur votre photo de profil
		3. Faites un clique droit et selectionner copier l'adresse du lien
		4. Collez le tout entre les guillemets 
		5. Changez la partie "400*400" en  "normal"
	3. - $me (votre pseudo suivi d'une parenthese ouvrante suivi  d'un "@" suivi de votre handle suivi d'une parenthese fermante)
7. - Dans le dossier ressource :
	1. - Placez votre dossier "direct_messages_media" de votre archive twitter
	2. - Placez votre ou vos fichiers qui commencent par "direct-messages.js" ou "direct-messages-part"
	
 8. - Exécuter "script/execute_scripts.bat
 9. - Executer "launch Sarahstat.bat"

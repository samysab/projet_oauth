# projet_oauth
Samy HAMED E SABERI
Mohamed KAJEIOU

# Comment utiliser ce projet ?

Ce projet est structuré suivant le design pattern appelé "Patron de Méthode".

Pour créer un provider, il suffit de créer un controller qui héritera de la classe abstraite ProviderController.


# Etape 1:

Démarrer les conteneurs Docker: "docker compose up" à la racine du projet.

# Etape 2:

Dans ce projet des clés secrètes sont utilisées, vous devez donc créer dans un fichier "config.php" les constantes suivantes.

CLIENT_ID = Clé d'identification Oauth
CLIENT_FBID = Clé d'identification Fb
CLIENT_GITID = Clé d'identification Github
CLIENT_SECRET = Clé secrète Oauth
CLIENT_FBSECRET = Clé secrète FB
CLIENT_GITSECRET = Clé secrète Github
STATE = Constante nécessaire pour les différents providers
APP_NAME = Constante nécessaire pour le nom d'application

# Etape 3:

Indiquer dans "index.php", le controller du provider pour pouvoir tester les différentes API.

Exemple: Si je veux me connecter via Github, il suffit d'instancier cette classe à la ligne 19 d' "index.php".
	$provider = new GithubController();

# Etape 4:

Rendez vous sur le lien suivant : https://localhost/login
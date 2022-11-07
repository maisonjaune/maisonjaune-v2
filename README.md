# La Maison Jaune

## Description

La Maison Jaune est un site web dédié au FC Nantes. Il contiendra :

- Des actualités
- Des informations sur le mercato
- Des informations sur la formation
- Le calendrier des matchs
- La possibilité de faire des pronostics
- Des photos et vidéos
- Et plein d'autres choses encore...

## Les prérequis

Pour l'installation et le développement du projet :

- [git](https://git-scm.com/book/fr/v2/D%C3%A9marrage-rapide-Installation-de-Git) est installé sur votre machine.
- Un IDE est installé sur votre machine afin de développer plus facilement.

## Récupération du projet

Faite un clone du dépôt :

```
git clone git@bitbucket.org:fan2misa/la-maison-jaune.git
```

## Installation du projet

### Installation du projet (en local via Wampp)

#### Pré requis
* [Wamp](https://www.wampserver.com/) est installé et configuré avec PHP 7.2 minimum.
* PHP est bien dans les variables d'environnement windows.
* [Composer](https://getcomposer.org/) est installé sur votre ordinateur.
* [Npm](https://nodejs.org/fr/) est installé sur votre ordinateur.

Nous partons du principe que `${INSTALL_DIR}` est égale au chemin d'installation de wampp
(par exemple: `C:\wamp`)

#### Préparation du virtualhost

Dans le fichier `${INSTALL_DIR}\bin\apache\apache<VERSION>\conf\httpd.conf`, vérifier que le
modules mod_vhost_alias est activé :
`LoadModule vhost_alias_module modules/mod_vhost_alias.so`

Vérifier également que le fichier `${INSTALL_DIR}\conf\extra\httpd-vhosts.conf` est bien inclus :
`Include conf/extra/httpd-vhosts.conf`

Ouvrez le fichier `${INSTALL_DIR}\bin\apache\apache<VERSION>\conf\extra\httpd-hosts.conf`
et ajouter le contenu suivant:

```
<VirtualHost *:80>
	ServerName maisonjaune.local
	DocumentRoot "${INSTALL_DIR}/www/la-maison-jaune/public"
	<Directory  "${INSTALL_DIR}/www/la-maison-jaune/public">
		AllowOverride None
        Order Allow,Deny
        Allow from All

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
	</Directory>
</VirtualHost>
```

ATTENTION : Pensez à adapter les chemins d'installation du projet.
Le checmin `${INSTALL_DIR}/www/la-maison-jaune/public` doit être remplacé par
le chemin du projet + le dossier `public` contenu dans le projet.

Modifier le fichier `C:\WINDOWS\System32\drivers\etc\hosts` et ajouter cette ligne :
`::1	maisonjaune.local`

Redémarrer votre serveur Wampp si celui-ci est lancé.

#### Préparation du projet

Ajouter un fichier `.env.local` à la racine du projet. Dans ce fichier, ajoute la ligne suivante :
`DATABASE_URL=mysql://root@localhost:3306/la_maison_jaune`

Ouvrez votre invite de commande et rendez-vous à la racine du projet.

Lancez la commande `composer install`.

Lancez la commande `php bin/console app:init`.
Si vous souhaitez plus de données, lancez plutot la commande `php bin/console app:init --group dev`.

**ATTENTION** : il vous sera probablement demandé d'ajouter des images dans le dossier `assets/fixtures/media/random/`.
Par exemple, dans `assets/fixtures/media/random/nodes/posts/`

Lancez la commande `npm install`.

Lancez la commande `grunt`.

rendez-vous sur [https://maisonjaune.local](https://maisonjaune.local).

### Installation du projet (via Docker)

#### Pré requis
* [Docker for windows](https://docs.docker.com/docker-for-windows/install/) est installé sur votre
  machine.

Rendez-vous dans le dossier `.docker`.

Créez un fichier nommé `.env` et copiez collez le contenu du fichier `.env.dist`.

Dans le fichier `.env`, vérifier la variable `COMPOSE_FILE`. Vous devez utiliser le
fichier `docker-compose.prod.yml` pour la production.

**ATTENTION** : Si vous êtes sous Windows, vous devez remplacer le `:` par un `;`.

Vous pouvez maintenant lancer les containers :

```
docker-compose up -d
```

Installez les libraires du projet à l'aide de composer :

```
docker-compose exec web composer install
```

Il est possible que vous rencontriez un soucis de mémoire lors du lancement de cette commande.
Dans ce cas, installez les librairies comme ceci :

```
docker-compose exec web COMPOSER_MEMORY_LIMIT=-1 composer install
```

Pour ajouter des données de dev supplémentaire, déposez des images dans le dossier
`assets/fixtures/media/random/`.

Ensuite, initialisez l'application (nettoyage, base de données, fixtures) :

```
docker-compose exec web php bin/console app:init
```

Rendez-vous à la racine du projet (`cd ../`) puis installez les librairies du
projet à l'aide de npm:

```
npm install
```

Générez les assets (CSS, JS) :

```
npm run build
```

## Développement du projet

Pour le développement CSS et JS, vous pouvez lancer la commande suivante :

```
npm run watch
```

Cela génerera les assets à chaque modification du JS et du SASS.

## Lancement des tests

Avant de lancer les tests, il vous faut préparer la base de données de test.
Pour cela, lancez la commande suivante :

```
php bin/console app:init --env test
```

Ensuite, lancez les tests avec la commande suivante :

```
php bin/phpunit
```
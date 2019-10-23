# ScanEtu

## Présentation du projet
TODO

## Dépendances

Les dépendances seront installées lors de la configuration du projet, et sont accessibles à partir des fichiers composer.json et package.json! Voici les principales dépendances que le projet utilise:

### composer.json
```
    "require": {
        "php": ">=7.0.0",
        "fideloper/proxy": "~3.3",
        "laravel/framework": "5.5.*",
        "laravel/tinker": "~1.0",
        "laravelnews/laravel-twbs4": "^1.3"
    },
    "require-dev": {
        "barryvdh/laravel-debugbar": "^3.2",
        "filp/whoops": "~2.0",
        "fzaninotto/faker": "~1.4",
        "mockery/mockery": "~1.0",
        "phpunit/phpunit": "~6.0",
        "symfony/thanks": "^1.0"
    }
```

### package.json
```
    "devDependencies": {
        "axios": "^0.17",
        "bootstrap": "^4.0.0",
        "cross-env": "^5.1",
        "jquery": "^3.2",
        "laravel-mix": "^1.0",
        "lodash": "^4.17.4",
        "popper.js": "^1.12.9",
        "vue": "^2.5.7"
    }
```

## Faire tourner le projet (en local)

### npm, composer, .env

Pour commencer, notre projet a des « dépendances ». Elles doivent être chargées au travers des gestionnaires dont le projet a besoin (à savoir [npm pour nodejs](https://www.npmjs.com/get-npm) et [composer pour PHP](https://getcomposer.org/download/)). Nous devons ainsi lancer les commandes suivantes:

```
npm install
composer install
```

Laravel a besoin d’un fichier contenant une variable d’environnement, non présent sur le répertoire pour des raisons de sécurité. Pour créer ce fichier, vous devrez taper les commandes suivantes:

```
copy .env.example .env    # pour WINDOWS
cp .env.example .env    # pour LINUX
php artisan key:generate
```

La dernière commande va générer la variable d’environnement APP_KEY. Cette dernière servira à crypter les sessions.

### Base de données, migrations et graines

Maintenant que le fichier .env est créé, il faut le configurer. Normalement, les paramètres de base devraient être corrects, à l’exception de trois champs. Vous devrez les configurer comme ci-dessous:

```php
DB_DATABASE=nomdb    # à remplacer par le nom de votre db
DB_USERNAME=nomuser    # à remplacer par l’utilisateur de votre db
DB_PASSWORD=motdepassedb    # à remplacer par le mot de passe de votre db
```

#### Lancer une migration

Par la suite, nous créerons les tables utilisées par le projet.
Leur structure est préparée dans les migrations (/database/migrations). Ce seront elles qui permettront de créer les tables dont nous avons besoin.  
Ensuite, pour les remplir, nous utiliserons les graines, ou seeds (/database/seeds).

***Important : si vous avez déjà installé le projet (et donc effectué une migration, il vous faut rafraîchir la base de données avec la commande suivante:***

```
php artisan migrate:refresh --seed
```

Cette commande met à jour la base de données. Pour en savoir plus, une explication détaillée se trouve dans la dernière migration.

***Dans le cas contraire (et uniquement!!), il suffit de lancer les deux commandes suivantes:***

```
php artisan migrate
php artisan db:seed
```

### Lancer des tests
TODO

### Allumer le serveur

Il ne nous reste maintenant plus qu’à allumer le serveur:

```
php artisan serve
```

### Régénérer les assets (public)

Ouvrez un autre cmd (si le serveur est lancé) et tapez la commande suivante, toujours à la racine du projet:
```
npm run dev
```
Cela va regénérer les fichiers css et js accessibles aux utilisateurs (public) à partir du dossier de développement frontend (resources).

Et voilà, le tour est joué ! Vous devriez avoir accès au projet. Maintenant, lisez bien les commentaires dans le code ! Ils vous aideront à mieux comprendre.

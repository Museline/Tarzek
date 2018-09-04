# Tarzek
Site communautaire d'un jeu de plate-forme (réalisé dans le cadre d'une formation pour la soutenance de fin)

Au moment où l'on récupère le dossier faire :
* composer install

Pensez à modifier dans le fichier .env "DATABASE_URL"

Pour créer la base de donnée selon "DATABASE_URL" :
* php bin/console doctrine:database:create

Puis créer les tables en bdd :
* php bin/console doctrine:migrations:migrate

# Encore
* npm i
* ./node_modules/.bin/encore dev-server (serveur encore)

# Serveur Symfony
* php bin/console server:run

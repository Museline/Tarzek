# Tarzek
Site communautaire d'un jeu de plate-forme

Au moment où l'on récupère le dossier faire :
* composer self-update (pour mettre à jour composer)
* composer update (pour mettre à jour les dépendances et installer les éventuelles manquantes)

Penser à modifier dans le fichier .env "DATABASE_URL"

Pour créer la base de donnée selon "DATABASE_URL" :
* php bin/console doctrine:database:create

Mettre à jour les tables en bdd
* php bin/console doctrine:migrations:diff
puis
* php bin/console doctrine:migrations:migrate

Pour lancer le serveur php :
* php bin/console server:run

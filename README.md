# Tarzek
Site communautaire d'un jeu de plate-forme (réalisé en 2 semaines)

Au moment où l'on récupère le dossier faire :
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

# Encore
Pour mettre en place Encore (utiliser node.js)
* npm i
* npm install -save jquery

Pour lancer le serveur encore :
* ./node_modules/.bin/encore dev-server

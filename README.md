# PlantsHub
Modifier le .env pour lui donner votre nom de base de données.

Lancer votre serveur local.

À l'aide de votre terminal installer les dépendance avec les commandes suivantes :

composer install

php bin/console doctrine:database:create

php bin/console doctrine:migration:migrate

entrez la commande php bin/console doctrine:fixtures:load pour preremplir la base de donnée

symfony server:start (si problème arrêtez votre server en faisant : symfony server:stop puis symfony server:start)

ouvrez votre navigateur puis copier "http://127.0.0.1:8000/accueil/"

Connectez vous a l'utilisateur admin mot de passe admin crée au préalable par le chargement des fixtures

PS: Les maquettes se situent dans le dossier maquettes

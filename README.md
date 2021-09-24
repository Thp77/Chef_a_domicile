# Mise en place du framework symfony

Avec de quoi faire des fixtures pour les tables de données

Avant toute chose, pensez à rentrer dans le terminal VS Code une fois le dossier ouvert (dans l'ordre):

composer install

symfony console doctrine:database:create

composer require --dev orm-fixtures

Suivre la doc Pour générer des données fake, utiliser faker (<https://github.com/fzaninotto/Faker>), c'est à dire entrer:

composer require fzaninotto/faker

Une fois tout ça fait,

php bin/console doctrine:migrations:migrate

symfony console doctrine:fixtures:load

(et si vous modifiez le fichier fixture ou une entité, pensez à faire avant la commande précédente:
symfony console make:migration
)

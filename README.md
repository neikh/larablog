# larablog
a laravel blog

--------------------------------

1) Installation et configuration de SQLite

On crée le fichier: database/database.sqlite

On édite le fichier .env en rajoutant les accès nécessaires : 

APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
DB_DATABASE=/blog6/larablog/database/database.sqlite

On utilise phpLiteAdmin pour administrer notre base SQLite:
https://www.phpliteadmin.org/download/

On copie les fichiers de phpLiteAdmin dans public/,
puis on peut y accèder à cette adresse : http://127.0.0.1:8000/phpliteadmin.php
Le mot de passe par défaut est admin.


-------------------------------------

MISC: Commandes utiles

Serveur local : 
php artisan serve


Base de données :
Migration : php artisan migrate 
Rollback une migration : php artisan migrate:rollback
Repartir de 0 : php artisan migrate:fresh
Créer une table 'projects' : php artisan make:migration create_projects_table


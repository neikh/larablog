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


2) Création de la partie authentification

    On peut le faire de manière automatique avec : php artisan make:auth
    Cela crée : 
        - home.blade.php, affiche un cadre signalant que l'utilisateur est bien connecté.
        - auth/login.blade.php, qui contient le formulaire de login
        - auth/register.blade.php, qui contient le formulaire d'inscription
        - auth/verify.blade.php, qui demande de vérifier une adresse e-mail
        - auth/passwords/email.blade.php, qui demande une adresse e-mail pour le renvoi d'un mdp oublié
        - auth/passwords/reset.blade.php, qui permet de réinitialiser un mot de passe d'un user
        - layouts/app.blade.php, affiche les liens login et register si guest, le nom du user si enregistré
        - Dons nos controller, on retrouve $this->middleware('auth'); dans le constructeur. Cela permet d'apeller notre authentification lorsque l'on apelle certains controller, ou les limiter à certaines fonctions d'un controller.

------------------------------------

Utilisation de blade

1) Généralités

    Pour afficher le contenu d'une vue dans un layout : @yield('content')
    On défini dans quel layout doit s'afficher le contenu d'une vue avec : @extends('main/template')
    Pour lier un yield depuis une vue : @section('content'), @endsection

    Boucler sur tous les éléments :
    @foreach, @endforeach

    Créer une condition :
    @if, @else, @endif

    Pour compter le nombre d'élément d'un tableau :
    $posts->count()


2) Authentification

    Si un user est enregistré : 
        @auth
            You are logged in.
        @endauth

    Si un user avec un guard : 
        @auth('admin')
            You are logged in through admin guard
        @endauth

    Si un user est guest :
        @guest
            Welcome Guest
        @endauth

-------------------------------------

MISC: Commandes utiles

    1) Serveur local : 

        php artisan serve


    2) Base de données :

        Migration : php artisan migrate 
        Rollback une migration : php artisan migrate:rollback
        Repartir de 0 : php artisan migrate:fresh
        Pour ajouter en plus des fausse données, on rajoute --seed après.
        Créer une table 'projects' : php artisan make:migration create_projects_table


    3) Création de fichiers PHP

        Créer un controller : php artisan make:Controller HomeController
        Créer un modèle : php artisan make:model Post
        Le modèle crée doit avoir le même nom que la base de données ! Si cce n'est pas le cas, il faut rajouter dasn le modèle : protected $table = 'my_flights';

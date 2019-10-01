<?php

return array('GET' =>
    ['news' => ['path' => '/',
        ['controller' => 'news', 'method' => 'listNewsPost']],
        'new' => ['path' => '/news-id',
            ['controller' => 'news', 'method' => 'newsPost']],
        'episodes' => ['path' => '/episodes',
            ['controller' => 'episodes', 'method' => 'listChapter']],
        'chapter' => ['path' => '/chapitre-id',
            ['controller' => 'episodes', 'method' => 'chapter']],
        'about' => ['path' => '/about',
            ['controller' => 'about', 'method' => 'getAboutPage']],
        'connexion' => ['path' => '/connexion',
            ['controller' => 'authentification', 'method' => 'authForm']],
        'deconnexion' => ['path' => '/deconnexion',
            ['controller' => 'authentification', 'method' => 'deconnexion']],
        'inscription' => ['path' => '/inscription',
            ['controller' => 'register', 'method' => 'registerForm']],

    ],


    'POST' => [
        'report-news' => ['path' => '/news-id',
            ['controller' => 'comments', 'method' => 'report']],
        'report-chapitre' => ['path' => '/chapitre-id',
            ['controller' => 'comments', 'method' => 'report']],
        'addComFromNews' => ['path' => '/addcoms-type-id',
            ['controller' => 'comments', 'method' => 'addComment']],
        'addComFromEpisodes' => ['path' => '/addcoms-type-id',
            ['controller' => 'comments', 'method' => 'addComment']],
        'registercontrole' => ['path' => '/registercheck',
            ['controller' => 'register', 'method' => 'registerValidation']],
        'getConnected' => ['path' => '/connexion',
            ['controller' => 'Authentification', 'method' => 'authValidator']],
    ]
);
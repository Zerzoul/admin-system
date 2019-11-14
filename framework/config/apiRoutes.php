<?php
/**
 *  Array for the API routes
 * @return array
 */
return array('GET' => [
        'posts' => ['path' => '/posts',
        ['controller' => 'posts', 'method' => 'listPosts']],
        'fishList' => ['path' => '/fishlist',
            ['controller' => 'fishList', 'method' => 'getFishList']],
        'comments' => ['path' => '/comments',
            ['controller' => 'comments', 'method' => 'getComments']],
        ],


    'POST' => [
        'nouveauCom' => ['path' => '/newcom',
            ['controller' => 'comments', 'method' => 'addCom']],
        'registration' => ['path' => '/registration',
            ['controller' => 'user', 'method' => 'registration']],
        'connection' => ['path' => '/authentification',
            ['controller' => 'authentification', 'method' => 'access']],
    ]
);
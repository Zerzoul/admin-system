<?php

return array('GET' => [
        'posts' => ['path' => '/posts',
        ['controller' => 'posts', 'method' => 'listPosts']],
        'fishList' => ['path' => '/fishlist',
            ['controller' => 'fishList', 'method' => 'getFishList']],],


    'POST' => [
        'nouveauCom' => ['path' => '/newcom',
            ['controller' => 'comments', 'method' => 'addCom']],
        'registration' => ['path' => '/registration',
            ['controller' => 'user', 'method' => 'registration']],
    ]
);
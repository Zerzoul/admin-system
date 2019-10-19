<?php

return array('GET' => [
        'posts' => ['path' => '/posts',
        ['controller' => 'posts', 'method' => 'listPosts']],
        'fishList' => ['path' => '/fishlist',
            ['controller' => 'fishList', 'method' => 'getFishList']],],


    'POST' => [
        'nouveauCom' => ['path' => '/newcom',
            ['controller' => 'comments', 'method' => 'addCom']],
        'add-com' => ['path' => '/addCom',
            ['controller' => 'comments', 'method' => 'report']],
    ]
);
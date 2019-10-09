<?php

return array('GET' => [
        'posts' => ['path' => '/posts',
        ['controller' => 'posts', 'method' => 'listPosts']],
        'fishList' => ['path' => '/fishlist',
            ['controller' => 'fishList', 'method' => 'getFishList']],],


    'POST' => [
        'report-news' => ['path' => '/news-id',
            ['controller' => 'comments', 'method' => 'report']],
        'add-com' => ['path' => '/addCom',
            ['controller' => 'comments', 'method' => 'report']],
    ]
);
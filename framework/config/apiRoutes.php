<?php

return array('GET' =>
    ['posts' => ['path' => '/posts',
        ['controller' => 'posts', 'method' => 'listPosts']],

    ],


    'POST' => [
        'report-news' => ['path' => '/news-id',
            ['controller' => 'comments', 'method' => 'report']],

    ]
);
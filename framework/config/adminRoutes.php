<?php

return array('GET' =>

    [
        'access' => ['path' => '/',
            ['controller' => 'authentification', 'method' => 'access']],
        'login' => ['path' => '/login',
            ['controller' => 'authentification', 'method' => 'formLogin']],
        'register' => ['path' => '/register',
            ['controller' => 'authentification', 'method' => 'formRegister']],
        'deconnexion' => ['path' => '/deconnexion',
            ['controller' => 'authentification', 'method' => 'deconnexion']],

        'Dashboard' => ['path' => '/dashboard',
            ['controller' => 'dashboard', 'method' => 'dashboard']],

        'billets' => ['path' => '/billets',
            ['controller' => 'ListBillet', 'method' => 'listBillet']],
        'billet' => ['path' => '/billet',
            ['controller' => 'ListBillet', 'method' => 'listBillet']],
        'billet-id' => ['path' => '/billet-id',
            ['controller' => 'ListBillet', 'method' => 'listBillet']],

        'trash-billets' => ['path' => '/thrashbillets',
            ['controller' => 'DeleteBillet', 'method' => 'listTrashBillet']],
        'trash-billets-id' => ['path' => '/thrashbillets-id',
            ['controller' => 'DeleteBillet', 'method' => 'listTrashBillet']],

        'add-billet' => ['path' => '/nouveaubillet',
            ['controller' => 'EditBillet', 'method' => 'billetForm']],
        'billet-to-delete-from-billet' => ['path' => '/billettodelete-id',
            ['controller' => 'DeleteBillet', 'method' => 'deleteBilletValidation']],
        'billet-to-delete-from-trashbillet' => ['path' => '/trashbillettodelete-id',
            ['controller' => 'DeleteBillet', 'method' => 'deleteBilletValidation']],
        'billet-to-update' => ['path' => '/update-id',
            ['controller' => 'EditBillet', 'method' => 'billetForm']],

        'add-fish' => ['path' => '/nouveaupoisson',
            ['controller' => 'EditFish', 'method' => 'fishForm']],

        'billet-to-restore' => ['path' => '/restore-id',
            ['controller' => 'DeleteBillet', 'method' => 'deleteBilletValidation']],

        'comments' => ['path' => '/comments',
            ['controller' => 'comments', 'method' => 'listComments']],

        'listing-users' => ['path' => '/users',
            ['controller' => 'users', 'method' => 'usersManager']],

    ],

    'POST' => [
        'new' => ['path' => 'login',
            ['controller' => 'authentification', 'method' => 'authValidator']],

        'create-Billet' => ['path' => '/nouveaubillet',
            ['controller' => 'EditBillet', 'method' => 'checkBillet']],
        'Update-Billet' => ['path' => 'update-id',
            ['controller' => 'EditBillet', 'method' => 'checkBillet']],
        'add-Fish' => ['path' => '/nouveaupoisson',
            ['controller' => 'EditFish', 'method' => 'checkFishForm']],


        'delete-billet-to-billet' => ['path' => '/billettodelete-id',
            ['controller' => 'DeleteBillet', 'method' => 'deleteBillet']],
        'delete-billet-to-trashbillet' => ['path' => '/trashbillettodelete-id',
            ['controller' => 'DeleteBillet', 'method' => 'deleteBillet']],
        'restore-billet' => ['path' => '/restore-id',
            ['controller' => 'DeleteBillet', 'method' => 'deleteBillet']],

        'check-com' => ['path' => '/checkCom-postId-id',
            ['controller' => 'comments', 'method' => 'checkCom']],
    ]
);
<?php

namespace controllers\admin;


class UsersController extends \framework\Controller
{
    public function usersManager()
    {
        $this->app->authAdmin();
        $usersCount = $this->app->getManager('users');
        $usersCount = $usersCount->countFromUsers();

        require '../app/view/admin/Users/tabsListUsers.php';
    }
}
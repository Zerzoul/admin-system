<?php

namespace controllers\home;


class UsersController extends \framework\Controller
{
    public function getUser($email)
    {
        $pseudoExist = $this->isTheEmailExist($email);

        if(!is_null($pseudoExist)) {
            $pseudoIsAnonyme = explode('0', $pseudoExist);
            if ($pseudoIsAnonyme[0] === 'Anonyme') {
                $pseudo = $pseudoExist;
            } else {
                header('Location: connexion');
                exit();
            }
        }  else {
            $pseudo = $this->assignPseudo();
            $this->addUser($pseudo, $email);
            }
        return $pseudo;
    }

    public function isTheEmailExist($email)
    {
        $users = $this->app->getManager('Users');
        $users = $users->getUsers();
        foreach ($users as $user) {
            if ($user->email === $email) {
                return $user->pseudo;
            }
        }
        return null;
    }

    public function assignPseudo()
    {
        $users = $this->app->getManager('Users');
        $userCount = $users->countUsers();
        $pseudoId = $userCount->counts + 1;
        $pseudo = 'Anonyme0' . $pseudoId;
        return $pseudo;
    }

    public function addUser($pseudo, $email)
    {
        $users = $this->app->getManager('Users');
        return $users->addAnonymeUsers($pseudo, $email);
    }
}
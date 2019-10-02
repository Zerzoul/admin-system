<?php


namespace models;

use \framework\Manager;

class UsersManager extends Manager
{
    public function countFromUsers()
    {
        $getUsers = $this->pdo->query('SELECT SUM(newsCount) AS userCount, t.id, t.pseudo, t.date_sign, t.email FROM
                                      (( SELECT COUNT(C.author) AS newsCount, B.id, B.pseudo, B.date_sign, B.email FROM user B LEFT JOIN newscomments C ON (B.pseudo = C.author) GROUP BY B.id)
                                        UNION ALL
                                        ( SELECT COUNT(E.author) AS episodesCount, D.id, D.pseudo, D.date_sign, D.email FROM user D LEFT JOIN episodescomments E ON (D.pseudo = E.author) GROUP BY D.id)
                                      )t GROUP BY t.id');
        $users = $getUsers->fetchAll(\PDO::FETCH_OBJ);
        return $users;
    }

    public function getUsers()
    {
        $getUsers = $this->pdo->query('SELECT id, pseudo, password, date_sign,email FROM user ');
        $users = $getUsers->fetchAll(\PDO::FETCH_OBJ);
        return $users;
    }

    public function getUser($name)
    {
        $getUser = $this->pdo->prepare('SELECT id, pseudo, password, date_sign,email FROM user WHERE pseudo = :pseudo ');
        $getUser->execute(array(
            'pseudo' => $name,
        ));
        $user = $getUser->fetch(\PDO::FETCH_LAZY);
        return isset($user) ? $user : false;

    }

    public function getAdminUser()
    {
        $getAdminUsers = $this->pdo->query('SELECT id, user_name, password, statue FROM adminmanager');
        $adminUsers = $getAdminUsers->fetchAll(\PDO::FETCH_OBJ);
        return $adminUsers;
    }

    public function countUsers()
    {
        $getUsers = $this->pdo->query('SELECT COUNT(*) AS counts FROM user ');
        $usersCount = $getUsers->fetch(\PDO::FETCH_LAZY);
        return $usersCount;
    }

    public function addAnonymeUsers($pseudo, $email)
    {
        $addUser = $this->pdo->prepare('INSERT INTO user(pseudo, email) VALUES (:pseudo, :email)');
        $addUser->execute(array(
            'pseudo' => $pseudo,
            'email' => $email,
        ));
        return $addUser;
    }

    public function addRealUsers($pseudo, $passHash, $email)
    {
        $addUser = $this->pdo->prepare('INSERT INTO user(pseudo, email, password) VALUES (:pseudo, :email, :password)');
        $addUser->execute(array(
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $passHash,
        ));
        return $addUser;
    }

    public function updateUsers($pseudo, $passHash, $email)
    {
        var_dump($pseudo, $passHash, $email);
        $updateUser = $this->pdo->prepare('UPDATE user SET pseudo = :pseudo, password = :password WHERE email = :email');
        $update = $updateUser->execute(array(
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $passHash,
        ));
        var_dump($update);
        return $update;
    }
}
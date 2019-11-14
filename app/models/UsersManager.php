<?php

/**
 * model user
 */
namespace models;

use \framework\Manager;

class UsersManager extends Manager
{
    /**
     * @return mixed
     */
   public function countFromUsers()
   {
       $getUsers = $this->pdo->query(' SELECT COUNT(C.author) AS count, U.id, U.pseudo, U.date_registration, U.email FROM user U LEFT JOIN comment C ON (U.pseudo = C.author) GROUP BY U.id');
       $users = $getUsers->fetchAll(\PDO::FETCH_OBJ);
       return $users;
   }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        $getUsers = $this->pdo->query('SELECT id, pseudo, password, date_registration,email FROM user ');
        $users = $getUsers->fetchAll(\PDO::FETCH_OBJ);
        return $users;
    }

    /**
     * @param $email
     * @return bool
     */
    public function getUser($email)
    {
        $getUser = $this->pdo->prepare('SELECT id, pseudo, password, date_registration, email FROM user WHERE email = :email ');
        $getUser->execute(array(
            'email' => $email,
        ));
        $user = $getUser->fetch(\PDO::FETCH_LAZY);
        return isset($user) ? $user : false;
    }

    /**
     * @return mixed
     */
    public function getAdminUser()
    {
        $getAdminUsers = $this->pdo->query('SELECT id, user_name, password, statue FROM adminmanager');
        $adminUsers = $getAdminUsers->fetchAll(\PDO::FETCH_OBJ);
        return $adminUsers;
    }

    /**
     * @return mixed
     */
    public function countUsers()
    {
        $getUsers = $this->pdo->query('SELECT COUNT(*) AS counts FROM user ');
        $usersCount = $getUsers->fetch(\PDO::FETCH_LAZY);
        return $usersCount;
    }

    /**
     * @param $pseudo
     * @param $passHash
     * @param $email
     * @return mixed
     */
    public function addUser($pseudo, $passHash, $email)
    {
        $addUser = $this->pdo->prepare('INSERT INTO user(pseudo, email, password) VALUES (:pseudo, :email, :password)');
        $addUser->execute(array(
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $passHash,
        ));
        return $addUser;
    }

    /**
     * @param $pseudo
     * @param $passHash
     * @param $email
     * @return mixed
     */
    public function updateUsers($pseudo, $passHash, $email)
    {
        $updateUser = $this->pdo->prepare('UPDATE user SET pseudo = :pseudo, password = :password WHERE email = :email');
        $update = $updateUser->execute(array(
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $passHash,
        ));
        return $update;
    }
}
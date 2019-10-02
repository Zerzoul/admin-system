<?php

namespace models;


class BilletManager extends \framework\Manager
{
    //FRONT
    public function getListPost($order)
    {
        $getPost = $this->pdo->prepare('SELECT id, title, content, date_create, date_modif FROM post WHERE statue=:statue AND isThrash=:isThrash ORDER BY id ' . $order);
        $getPost->execute(array(
            'statue' => parent::PUBLISHED,
            'isTrash' => 0));
        $getPost = $getPost->fetchAll(\PDO::FETCH_OBJ);
        return $getPost;
    }

    public function getPost($id)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, content, date_create, date_modif FROM post WHERE id=:id AND statue=:statue');
        $getNews->execute(array(
            'id' => $id,
            'statue' => parent::PUBLISHED));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    //ADMIN
    public function getListBillet($isThrash)
    {
        $getListBillet = $this->pdo->prepare('SELECT id, title, content, date_create, date_modif, statue FROM post WHERE isThrash=:isThrash ');
        $getListBillet->execute(array('isThrash' => $isThrash,));
        $getListBillet = $getListBillet->fetchAll(\PDO::FETCH_OBJ);
        return $getListBillet;
    }

    public function getCountBillet($isThrash, $statue)
    {
        $getBillets = $this->pdo->prepare('SELECT COUNT(id) AS postCount FROM post WHERE isThrash=:isThrash AND statue=:statue');
        $getBillets->execute(array('isThrash' => $isThrash, 'statue' => $statue));
        $getBillets = $getBillets->fetch(\PDO::FETCH_LAZY);
        return $getBillets;
    }

    public function getTheBilletWithoutTrash($id)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, content, date_create, date_modif, statue, isThrash FROM post WHERE id=:id ');
        $getNews->execute(array(
            'id' => $id
        ));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    public function getTheBillet($id, $isThrash)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, content, date_create, date_modif, statue, isThrash FROM post WHERE id=:id AND isThrash=:isThrash');
        $getNews->execute(array(
            'id' => $id,
            'isThrash' => $isThrash
        ));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    public function addBillet($title, $content, $statue)
    {
        $prepareAdding = $this->pdo->prepare('INSERT INTO post (title, content, statue) VALUES (:title, :content, :statue)');
        $addBillet = $prepareAdding->execute(array(
            'title' => $title,
            'content' => $content,
            'statue' => $statue,
        ));
        return $addBillet;
    }

    public function updateBillet($id, $title, $content, $statue, $date)
    {
        var_dump($date);
        $prepareUpdate = $this->pdo->prepare('UPDATE post SET title = :title, content = :content, statue = :statue, date_modif = :date_modif WHERE id = :id');
        $updateBillet = $prepareUpdate->execute(array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'statue' => $statue,
            'date_modif' => $date
        ));
        return $updateBillet;
    }

    public function trashThisBillet($id)
    {
        $trashThisBillet = $this->pdo->prepare('UPDATE post SET isThrash = :isThrash WHERE id = :id');
        $trashThisBillet = $trashThisBillet->execute(array(
            'isThrash' => 1,
            'id' => $id
        ));
        return $trashThisBillet;
    }

    public function deleteThisBillet($id)
    {
        $deleteThisBillet = $this->pdo->prepare('DELETE FROM post WHERE id=:id ');
        $deleteThisBillet = $deleteThisBillet->execute(array('id' => $id));
        $deleteThisBilletCom = $this->pdo->prepare('DELETE FROM comment WHERE post_id = :post_id ');
        $deleteThisBilletCom->execute(array('post_id' => $id));
        return $deleteThisBillet;
    }

    public function restoreThisBillet($id)
    {
        $trashThisBillet = $this->pdo->prepare('UPDATE post SET isThrash = :isThrash, statue = :statue WHERE id = :id');
        $trashThisBillet = $trashThisBillet->execute(array(
            'isThrash' => 0,
            'statue' => 2,
            'id' => $id
        ));
        return $trashThisBillet;
    }
}

<?php

namespace models;


class NewsManager extends \framework\Manager
{
    //FRONT
    public function getListNews($table, $order)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, post, date_create, date_modif FROM ' . $table . ' WHERE statue=:statue AND isTrashed=:isTrashed ORDER BY id ' . $order);
        $getNews->execute(array(
            'statue' => parent::PUBLISHED,
            'isTrashed' => 0));
        $dataNews = $getNews->fetchAll(\PDO::FETCH_OBJ);
        return $dataNews;
    }

    public function getTheNews($table, $id)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, post, date_create, date_modif FROM ' . $table . ' WHERE id=:id AND statue=:statue');
        $getNews->execute(array(
            'id' => $id,
            'statue' => parent::PUBLISHED));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    //ADMIN
    public function getListBillet($table, $isTrashed)
    {
        $getBillets = $this->pdo->prepare('SELECT id, title, post, date_create, date_modif, statue FROM ' . $table . ' WHERE isTrashed=:isTrashed ');
        $getBillets->execute(array('isTrashed' => $isTrashed,));
        $getBillets = $getBillets->fetchAll(\PDO::FETCH_OBJ);
        return $getBillets;
    }

    public function getCountBillet($isTrashed, $statue)
    {
        $getBillets = $this->pdo->prepare('SELECT SUM(t.post) AS billetCount FROM 
                                          ((SELECT COUNT(A.id) AS post FROM newspost A WHERE isTrashed=:isTrashed AND statue=:statue)
                                            UNION ALL
                                            (SELECT COUNT(B.id) As post FROM episodespost B WHERE isTrashed=:isTrashed AND statue=:statue)
                                          ) AS t');
        $getBillets->execute(array('isTrashed' => $isTrashed, 'statue' => $statue));
        $getBillets = $getBillets->fetch(\PDO::FETCH_LAZY);
        return $getBillets;
    }

    public function getTheBilletWithoutTrash($table, $id)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, post, date_create, date_modif, statue, isTrashed FROM ' . $table . ' WHERE id=:id ');
        $getNews->execute(array(
            'id' => $id
        ));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    public function getTheBillet($table, $id, $isTrashed)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, post, date_create, date_modif, statue, isTrashed FROM ' . $table . ' WHERE id=:id AND isTrashed=:isTrashed');
        $getNews->execute(array(
            'id' => $id,
            'isTrashed' => $isTrashed
        ));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    public function addBillet($table, $title, $post, $statue)
    {
        $prepareAdding = $this->pdo->prepare('INSERT INTO ' . $table . '(title, post, statue) VALUES (:title, :post, :statue)');
        $addBillet = $prepareAdding->execute(array(
            'title' => $title,
            'post' => $post,
            'statue' => $statue,
        ));
        return $addBillet;
    }

    public function updateBillet($id, $table, $title, $post, $statue, $date)
    {
        $prepareUpdate = $this->pdo->prepare('UPDATE ' . $table . ' SET title = :title, post = :post, statue = :statue, date_modif = :date_modif WHERE id = :id');
        $updateBillet = $prepareUpdate->execute(array(
            'id' => $id,
            'title' => $title,
            'post' => $post,
            'statue' => $statue,
            'date_modif' => $date
        ));
        return $updateBillet;
    }

    public function trashThisBillet($table, $id)
    {
        $trashThisBillet = $this->pdo->prepare('UPDATE ' . $table . ' SET isTrashed = :isTrashed WHERE id = :id');
        $trashThisBillet = $trashThisBillet->execute(array(
            'isTrashed' => 1,
            'id' => $id
        ));
        return $trashThisBillet;
    }

    public function deleteThisBillet($table, $tableCom, $id)
    {
        $deleteThisBillet = $this->pdo->prepare('DELETE FROM ' . $table . ' WHERE id=:id ');
        $deleteThisBillet = $deleteThisBillet->execute(array('id' => $id));
        $deleteThisBilletCom = $this->pdo->prepare('DELETE FROM ' . $tableCom . ' WHERE post_id = :post_id ');
        $deleteThisBilletCom->execute(array('post_id' => $id));
        return $deleteThisBillet;
    }

    public function restoreThisBillet($table, $id)
    {
        $trashThisBillet = $this->pdo->prepare('UPDATE ' . $table . ' SET isTrashed = :isTrashed, statue = :statue WHERE id = :id');
        $trashThisBillet = $trashThisBillet->execute(array(
            'isTrashed' => 0,
            'statue' => 2,
            'id' => $id
        ));
        return $trashThisBillet;
    }
}

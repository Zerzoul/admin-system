<?php
/**
 * Model for new post
 */
namespace models;

class BilletManager extends \framework\Manager
{
    //FRONT
    /**
     * Get all post with the statue published not in the trash
     * @param $order
     * @return mixed
     */
    public function getListPost($order)
    {
        $getPost = $this->pdo->prepare('SELECT p.id, p.title, p.content, i.file_id, p.date_create FROM post p LEFT JOIN image_upload i ON p.file_id = i.id WHERE p.statue=:statue AND p.isThrash=:isThrash ORDER BY p.id ' . $order);
        $getPost->execute(array(
            'statue' => 1,
            'isThrash' => 0));
        $getPost = $getPost->fetchAll(\PDO::FETCH_OBJ);
        return $getPost;
    }

    //ADMIN

    /**
     * Get list of billet for the back-office
     * @param $isThrash
     * @return mixed
     */
    public function getListBillet($isThrash)
    {
        $getListBillet = $this->pdo->prepare('SELECT p.id, p.title, p.content, i.file_id, p.date_create, p.date_modif, p.statue FROM post p LEFT JOIN image_upload i ON p.file_id = i.id  WHERE isThrash=:isThrash ');
        $getListBillet->execute(array('isThrash' => $isThrash,));
        $getListBillet = $getListBillet->fetchAll(\PDO::FETCH_OBJ);

        return $getListBillet;
    }

    /**
     * Get a count of billet
     * @param $isThrash
     * @param $statue
     * @return mixed
     */
    public function getCountBillet($isThrash, $statue)
    {
        $getBillets = $this->pdo->prepare('SELECT COUNT(id) AS postCount FROM post WHERE isThrash=:isThrash AND statue=:statue');
        $getBillets->execute(array('isThrash' => $isThrash, 'statue' => $statue));
        $getBillets = $getBillets->fetch(\PDO::FETCH_LAZY);
        return $getBillets;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTheBilletWithoutTrash($id)
    {
        $getNews = $this->pdo->prepare('SELECT id, title, content, date_create, date_modif, statue, isThrash FROM post WHERE id=:id ');
        $getNews->execute(array(
            'id' => $id
        ));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    /**
     * @param $id
     * @param $isThrash
     * @return mixed
     */
    public function getTheBillet($id, $isThrash)
    {
        $getNews = $this->pdo->prepare('SELECT p.id, p.title, p.content, i.file_id, p.date_create, p.date_modif, p.statue, p.isThrash FROM post p LEFT JOIN image_upload i ON p.file_id = i.id WHERE p.id=:id AND p.isThrash=:isThrash');
        $getNews->execute(array(
            'id' => $id,
            'isThrash' => $isThrash
        ));
        $dataNews = $getNews->fetch(\PDO::FETCH_LAZY);
        return $dataNews;
    }

    /**
     * @param $title
     * @param $content
     * @param $imageId
     * @param $statue
     * @return mixed
     */
    public function addBillet($title, $content, $imageId,$statue)
    {
        $prepareAdding = $this->pdo->prepare('INSERT INTO post (title, content, file_id,statue) VALUES (:title, :content, :file_id,:statue)');
        $addBillet = $prepareAdding->execute(array(
            'title' => $title,
            'content' => $content,
            'file_id' => $imageId,
            'statue' => $statue,
        ));
        return $addBillet;
    }

    /**
     * @param $id
     * @param $title
     * @param $content
     * @param $image
     * @param $statue
     * @param $date
     * @return mixed
     */
    public function updateBillet($id, $title, $content, $image,$statue, $date)
    {
        $prepareUpdate = $this->pdo->prepare('UPDATE post SET title = :title, content = :content, file_id = :file_id,statue = :statue, date_modif = :date_modif WHERE id = :id');
        $updateBillet = $prepareUpdate->execute(array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'file_id' => $image,
            'statue' => $statue,
            'date_modif' => $date
        ));
        return $updateBillet;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function trashThisBillet($id)
    {
        $trashThisBillet = $this->pdo->prepare('UPDATE post SET isThrash = :isThrash WHERE id = :id');
        $trashThisBillet = $trashThisBillet->execute(array(
            'isThrash' => 1,
            'id' => $id
        ));
        return $trashThisBillet;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteThisBillet($id)
    {
        $deleteThisBillet = $this->pdo->prepare('DELETE FROM post WHERE id=:id ');
        $deleteThisBillet = $deleteThisBillet->execute(array('id' => $id));
        $deleteThisBilletCom = $this->pdo->prepare('DELETE FROM comment WHERE post_id = :post_id ');
        $deleteThisBilletCom->execute(array('post_id' => $id));
        return $deleteThisBillet;
    }

    /**
     * @param $id
     * @return mixed
     */
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

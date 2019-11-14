<?php
/**
 * Model for back-office event
 */

namespace models;


class SystemManager extends \framework\Manager
{
    /**
     * @param $name
     * @return mixed
     */
    public function addImage($name){
        $prepareAdding = $this->pdo->prepare('INSERT INTO image_upload (file_id)  VALUES (:file_id)');
        $prepareAdding->execute(array(
            'file_id' => $name,
        ));

        $imageId = $this->pdo->query('SELECT LAST_INSERT_ID() as image_id');
        $imageId = $imageId->fetch();
        return $imageId['image_id'];
    }
}
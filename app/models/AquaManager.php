<?php
/**
 * Model for fish fiche management
 */

namespace models;


class AquaManager extends \framework\Manager
{
    /**
     * add a new category and return the id
     * @param $category_name
     * @return mixed
     */
    public function addCategory($category_name){
        $prepareAdding = $this->pdo->prepare('INSERT INTO category_fish (category_name) VALUES (:category_name)');
        $category = $prepareAdding->execute(array(
            'category_name' => $category_name,
        ));
        $categoryId = $this->pdo->query('SELECT LAST_INSERT_ID() as category_id');
        $categoryId = $categoryId->fetch();
        return $categoryId['category_id'];
    }

    /**
     * Add a new fish fiche
     * @param $fish
     * @param $heat
     * @param $categoryId
     * @param $imageId
     * @return mixed
     */
    public function addFish($fish, $heat,$categoryId, $imageId)
    {
        $prepareAdding = $this->pdo->prepare('INSERT INTO aqua_fish (category, latin_name, commun_name, regime, size, heat, PH, GH, vol_mini, individual_mini, detail, price, image) VALUES (:category, :latin_name, :commun_name, :regime, :size, :heat, :PH, :GH, :vol_mini, :individual_mini, :detail, :price, :image)');
        $addFish = $prepareAdding->execute(array(
            'category' => $categoryId,
            'latin_name' => $fish['latin_name'],
            'commun_name' => $fish['commun_name'],
            'regime' => $fish['regime'],
            'size' => $fish['size'],
            'heat' => $heat,
            'PH' => $fish['ph'],
            'GH' => $fish['ph'],
            'vol_mini' => $fish['vol_mini'],
            'individual_mini' => $fish['individual_mini'],
            'detail' => $fish['content_detail'],
            'price' => $fish['price'],
            'image' => $imageId,
        ));
        return $addFish;
    }

    /**
     * Update a fish fiche
     * @param $fish
     * @param $heat
     * @param $categoryId
     * @param $imageId
     * @param $id
     * @return mixed
     */
    public function updateFish($fish, $heat,$categoryId, $imageId, $id)
    {
        $prepareAdding = $this->pdo->prepare('UPDATE aqua_fish SET category = :category, latin_name = :latin_name, commun_name = :commun_name, regime = :regime, size = :size, heat = :heat, PH = :PH, GH = :GH, vol_mini = :vol_mini, individual_mini = :individual_mini, detail = :detail, price = :price, image = :image WHERE id = :id');
        $updateFish = $prepareAdding->execute(array(
            'category' => $categoryId,
            'latin_name' => $fish['latin_name'],
            'commun_name' => $fish['commun_name'],
            'regime' => $fish['regime'],
            'size' => $fish['size'],
            'heat' => $heat,
            'PH' => $fish['ph'],
            'GH' => $fish['ph'],
            'vol_mini' => $fish['vol_mini'],
            'individual_mini' => $fish['individual_mini'],
            'detail' => $fish['content_detail'],
            'price' => $fish['price'],
            'image' => $imageId,
            'id' => $id,
        ));
        return $updateFish;
    }

    /**
     * Delete a fish fiche
     * @param $id
     * @return mixed
     */
    public function deleteFish($id){
        $prepareAdding = $this->pdo->prepare('DELETE FROM aqua_fish WHERE id = :id');
        $deleteFish = $prepareAdding->execute(array(
            'id' => $id,
        ));
        return $deleteFish;
    }

    /**
     * Get all fish fiche
     * @return mixed
     */
    public function getAllFishes(){
        $getAllFishes = $this->pdo->query('SELECT f.id, c.category_name, f.latin_name, f.commun_name, f.regime, f.size, f.heat, f.PH, f.GH, f.vol_mini, f.individual_mini, f.detail, f.price, i.file_id FROM aqua_fish f LEFT JOIN category_fish c ON f.category = c.id  LEFT JOIN image_upload i ON f.image = i.id ');
        $getAllFishes = $getAllFishes->fetchAll(\PDO::FETCH_OBJ);
        return $getAllFishes;
    }

    /**
     * Get juste one fish fiche
     * @param $id
     * @return mixed
     */
    public function getTheFish($id){
        $getTheFish = $this->pdo->prepare('SELECT f.id, c.category_name, f.latin_name, f.commun_name, f.regime, f.size, f.heat, f.PH, f.GH, f.vol_mini, f.individual_mini, f.detail, f.price, i.file_id FROM aqua_fish f LEFT JOIN category_fish c ON f.category = c.id  LEFT JOIN image_upload i ON f.image = i.id WHERE f.id = :id ');
        $getTheFish->execute(array(
            'id' => $id,
        ));
        $getTheFish = $getTheFish->fetch(\PDO::FETCH_LAZY);
        return $getTheFish;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 04/10/2019
 * Time: 21:12
 */

namespace models;


class AquaManager extends \framework\Manager
{
    public function addCategory($category_name){
        $prepareAdding = $this->pdo->prepare('INSERT INTO category_fish (category_name) VALUES (:category_name)');
        $category = $prepareAdding->execute(array(
            'category_name' => $category_name,
        ));
        $categoryId = $this->pdo->query('SELECT LAST_INSERT_ID() as category_id');
        $categoryId = $categoryId->fetch();
        return $categoryId['category_id'];
    }
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

    public function getAllFishes(){
        $getAllFishes = $this->pdo->query('SELECT f.id, c.category_name, f.latin_name, f.commun_name, f.regime, f.size, f.heat, f.PH, f.GH, f.vol_mini, f.individual_mini, f.detail, f.price, i.file_id FROM aqua_fish f INNER JOIN category_fish c ON f.category = c.id  INNER JOIN image_upload i ON f.image = i.id ');
        $getAllFishes = $getAllFishes->fetchAll(\PDO::FETCH_OBJ);
        return $getAllFishes;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 01/10/2019
 * Time: 21:47
 */
namespace controllers\api;

class FishListController extends \framework\Controller
{
    // return allFishes data
    public function getFishList(){
        $getFishList = $this->app->getManager('aqua');
        $getFishList = $getFishList->getAllFishes();
        return $getFishList;
    }

}
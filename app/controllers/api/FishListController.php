<?php
/**
 * Return all fish's fiche
 */
namespace controllers\api;

class FishListController extends \framework\Controller
{
    public function getFishList(){
        $getFishList = $this->app->getManager('aqua');
        $getFishList = $getFishList->getAllFishes();
        return $getFishList;
    }

}
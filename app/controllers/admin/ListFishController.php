<?php

namespace controllers\admin;
use framework\Controller;

class ListFishController extends Controller
{
    public function listFish(){
        $this->app->authAdmin();
        $id = $this->id;
        $path = $this->path;
        $titleList = 'Listes des poissons';
        $isThrash = 0;

        $getFishList = $this->app->getManager('aqua');
        $getFishList = $getFishList->getAllFishes();

//        if (!is_null($id)) {
//            $updateFish = $this->getTheFish($id);
//        }

        require_once '../app/view/admin/aqua-helper/tabsFishList.php';
    }

}
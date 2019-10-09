<?php

namespace controllers\admin;
use framework\Controller;

class ListFishController extends Controller
{
    protected $fishDeleted = 'La fiche à été suprimer';
    protected $notfication = false;

    public function listFish(){
        $this->app->authAdmin();
        $id = $this->id;
        $path = $this->path;

        if(isset($_SESSION['fishDeleted'])){
            $this->notfication = true;
            $message =  $this->fishDeleted;

            unset($_SESSION['fishDeleted']);
        }

        $titleList = 'Listes des poissons';

        $getFishList = $this->app->getManager('aqua');
        $getFishList = $getFishList->getAllFishes();
        $notfication = $this->notfication;
        require_once '../app/view/admin/aqua-helper/tabsFishList.php';
    }
    public function deleteFish(){
        if(isset($this->id)){
            $deleteFish = $this->app->getManager('aqua');
            $fishDeleted = $deleteFish->deleteFish($this->id);
            $_SESSION['fishDeleted'] = $fishDeleted;
        }
        header('Location: fishlist');
    }
}
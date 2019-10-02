<?php


namespace controllers\admin;
require_once 'BilletController.php';


class ListBilletController extends BilletController
{

    public function listBillet()
    {
        $this->app->authAdmin();
        $id = $this->id;
        $path = $this->path;
        $titleList = 'Listes des billets';
        $isThrash = 0;

        $listBillet = $this->displayAllBillet($isThrash);

        if (!is_null($id)) {
            $actionBillet = $this->getTheBillet($id, $isThrash);
            $statue = $this->getTheStatue($actionBillet->statue);
        }

        $isIdNull = $this->isIdNull;
        $bouton1 = 'Modification';
        $linkAction1 = "update";
        $bouton2 = 'Supprimer';
        $linkAction2 = "billettodelete";

        require parent::LIST_BILLET_PATH;
    }


}
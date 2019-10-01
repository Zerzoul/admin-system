<?php


namespace controllers\admin;
require_once 'BilletController.php';


class ListBilletController extends BilletController
{

    public function listBillet()
    {
        $this->app->authAdmin();
        $type = $this->type;
        $id = $this->id;
        $path = $this->path;
        $titleList = 'Listes des billets';
        if (is_null($type)) {
            $type = 'news';
        }

        $typeSelected = $type;
        $isTrashed = 0;

        if (!is_null($type)) {
            $table = $this->selectTable($type);
            $listBillet = $this->displayAllBillet($table, $isTrashed);

            if (!is_null($id)) {
                $actionBillet = $this->getTheBillet($table, $id, $isTrashed);
                $statue = $this->getTheStatue($actionBillet->statue);
            }
        }
        $isTypeNull = $this->isTypeNull;
        $isIdNull = $this->isIdNull;
        $bouton1 = 'Modification';
        $linkAction1 = "update";
        $bouton2 = 'Supprimer';
        $linkAction2 = "billettodelete";

        require parent::LIST_BILLET_PATH;
    }


}
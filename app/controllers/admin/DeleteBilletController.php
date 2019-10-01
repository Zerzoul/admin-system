<?php


namespace controllers\admin;
require_once 'BilletController.php';

class DeleteBilletController extends BilletController
{

    public function listTrashBillet()
    {
        $this->app->authAdmin();
        $type = $this->type;
        $id = $this->id;
        $path = $this->path;
        $titleList = 'Corbeille';
        if (is_null($type)) {
            $type = 'news';
        }
        $typeSelected = $type;
        $isTrashed = 1;

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
        $bouton1 = 'Restorer';
        $linkAction1 = "restore";
        $bouton2 = 'Supprimer';
        $linkAction2 = "trashbillettodelete";

        require parent::LIST_BILLET_PATH;
    }


    public function deleteBilletValidation()
    {
        $type = $this->type;
        $id = $this->id;

        $table = $this->selectTable($type);
        $news = $this->app->getManager('news');
        $isTrashed = $news->getTheBilletWithoutTrash($table, $id);

        if ($this->path === 'billettodelete' || $this->path === 'trashbillettodelete') {
            if ($isTrashed->isTrashed !== '0') {
                $messageToValid = 'de supprimer définitivement :';
            } else {
                $messageToValid = 'de mettre à la corbeille :';
            }
            $action = 'Supprimer';
            $deleteComs = 'Et de supprimer les commentaires liés à celui-ci.';
        } else {
            $messageToValid = 'de restaurer :';
            $deleteComs = '';
            $action = 'Restaurer';
        }
        if ($type === 'news') {
            $typeToDefine = 'La ' . ucfirst($type);
        } else {
            $typeToDefine = 'L\' ' . ucfirst($type);
        }
        $billetToDelete = $typeToDefine . ' N° ' . $id . ' <span class="font-italic">"' . $isTrashed->title . '"</span>.';

        require '../app/view/admin/Billets/deleteBilletValidation.php';
    }

    public function deleteBillet()
    {
        $type = $this->type;
        $id = $this->id;
        var_dump($this->path);

        if ($_POST['validationDeleteBillet'] == 'Annuler') {
            $this->cancelDeleteAction();
            exit();
        }
        $table = $this->selectTable($type);
        $tableCom = $this->selectTableComments($type);
        $news = $this->app->getManager('news');
        $isTrashed = $news->getTheBilletWithoutTrash($table, $id);

        if ($isTrashed->isTrashed !== '0') {
            if ($_POST['validationDeleteBillet'] == 'Restaurer') {
                $news->restoreThisBillet($table, $id);
                header('Location: billets');
                exit();
            }
            $news->deleteThisBillet($table, $tableCom, $id);
            header('Location: trashbillets');
            exit();
        } else {
            $news->trashThisBillet($table, $id);
            header('Location: billets');
            exit();
        }
    }

    public function cancelDeleteAction()
    {
        $this->path === 'billettodelete' ? $path = 'billets' : $path = 'trashbillets';
        header('Location:' . $path);
    }

}
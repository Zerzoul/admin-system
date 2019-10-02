<?php


namespace controllers\admin;
require_once 'BilletController.php';

class DeleteBilletController extends BilletController
{

    public function listTrashBillet()
    {
        $this->app->authAdmin();
        $id = $this->id;
        $path = $this->path;
        $titleList = 'Corbeille';

        $isThrash = 1;
        $listBillet = $this->displayAllBillet($isThrash);

            if (!is_null($id)) {
                $actionBillet = $this->getTheBillet($id, $isThrash);
                $statue = $this->getTheStatue($actionBillet->statue);
            }

        $isIdNull = $this->isIdNull;
        $bouton1 = 'Restorer';
        $linkAction1 = "restore";
        $bouton2 = 'Supprimer';
        $linkAction2 = "trashbillettodelete";

        require parent::LIST_BILLET_PATH;
    }


    public function deleteBilletValidation()
    {
        $id = $this->id;

        $post = $this->app->getManager('billet');
        $isThrash = $post->getTheBilletWithoutTrash($id);

        if ($this->path === 'billettodelete' || $this->path === 'trashbillettodelete') {
            if ($isThrash->isThrash !== '0') {
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

        $billetToDelete = 'Le billet N° ' . $id . ' <span class="font-italic">"' . $isThrash->title . '"</span>.';

        require '../app/view/admin/Billets/deleteBilletValidation.php';
    }

    public function deleteBillet()
    {

        $id = $this->id;
        var_dump($this->path);

        if ($_POST['validationDeleteBillet'] == 'Annuler') {
            $this->cancelDeleteAction();
            exit();
        }

        $post = $this->app->getManager('billet');
        $isThrash = $post->getTheBilletWithoutTrash($id);

        if ($isThrash->isThrash !== '0') {
            if ($_POST['validationDeleteBillet'] == 'Restaurer') {
                $post->restoreThisBillet( $id);
                header('Location: billets');
                exit();
            }
            $post->deleteThisBillet($id);
            header('Location: trashbillets');
            exit();
        } else {
            $post->trashThisBillet($id);
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
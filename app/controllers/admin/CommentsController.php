<?php


namespace controllers\admin;
require_once 'BilletController.php';

class CommentsController extends BilletController
{

    public function listComments()
    {
        $this->app->authAdmin();
        $type = $this->type;
        $id = $this->id;
        $path = $this->path;

        if (is_null($type)) {
            $type = 'news';
        }
        $typeSelected = $type;

        if (!is_null($type)) {
            $tableCom = $this->selectTableComments($type);
            $tablePost = $this->selectTable($type);
            $listCom = $this->displayAllComments($tableCom, $tablePost);

            if (!is_null($id)) {
                $checkCom = 'checkcom-' . $type . '-' . $id . '-' . $_GET['idCom'];
                isset($_GET['idCom']) ? $id = $_GET['idCom'] : $id;
                $actionCom = $this->displayComment($tableCom, $tablePost, $id);
            }
        }
        $isTypeNull = $this->isTypeNull;
        $isIdNull = $this->isIdNull;

        require '../app/view/admin/Comments/comments.php';
    }

    public function checkCom()
    {
        $action = $_POST['actionOnCom'];
        // nouveau et signalé remis à 0
        $actionOnCom = null;
        if (isset($action)) {
            $action === 'valider' ? $actionOnCom = 4 : $actionOnCom = 5;
        }
        $tableCom = $this->selectTableComments($this->type);
        $updateStatueCom = $this->updateStatueComment($tableCom, $this->id, $actionOnCom);

        if (!$updateStatueCom) {
            throw new \Exception('invalid statue action');
        }
        header('Location: comments-' . $this->type);
        exit();
    }

}
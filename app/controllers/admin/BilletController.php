<?php

namespace controllers\admin;

class BilletController extends \framework\Controller
{

    const LIST_BILLET_PATH = '../app/view/admin/Billets/billets.php';
    protected $isIdNull = true;
    protected $isTypeNull = true;
    protected $type;
    protected $id;

    public function displayAllBillet($table, $isTrashed)
    {
        $this->isTypeNull = false;
        $news = $this->app->getManager('news');
        return $news->getListBillet($table, $isTrashed);
    }

    public function getTheBillet($table, $id, $isTrashed)
    {
        $news = $this->app->getManager('news');
        $this->isIdNull = false;
        return $news->getTheBillet($table, $id, $isTrashed);
    }

    public function updateBillet($id, $table, $title, $post, $statue, $date)
    {
        $updateBillet = $this->app->getManager('news');
        $updateBillet = $updateBillet->updateBillet($id, $table, $title, $post, $statue, $date);

        if ($updateBillet) {
            return true;
        } else {
            return $error = 'Une erreur c\'est prodduite. Votre billet n\'a pas pu être modifier';
        }
    }

    public function addBillet($table, $title, $post, $statue)
    {
        $addBillet = $this->app->getManager('news');
        $addBillet = $addBillet->addBillet($table, $title, $post, $statue);

        if ($addBillet) {
            return true;
        } else {
            return $error = 'Une erreur c\'est prodduite. Votre billet n\'a pas pu être enregistrer';
        }
    }

    public function displayAllComments($tableCom, $tablePost)
    {
        $this->isTypeNull = false;
        $news = $this->app->getManager('comments');
        return $news->getAllComments($tableCom, $tablePost);
    }

    public function displayComment($tableCom, $tablePost, $id)
    {
        $this->isIdNull = false;
        $com = $this->app->getManager('comments');
        return $com->getComment($tableCom, $tablePost, $id);
    }

    public function updateStatueComment($tableCom, $id, $statue)
    {
        $com = $this->app->getManager('comments');
        return $com->updateStatueComment($tableCom, $id, $statue);
    }

    public function selectTheType()
    {
        if ($_POST['type'] === 'Type') {
            header('Location:' . $this->path);
        } elseif ($_POST['type'] !== $this->type) {
            $this->type = $_POST['type'];
        }
        var_dump($this->path);
        header('Location: ' . $this->path . '-' . $this->type);
    }

    public function statueReport($obj)
    {
        $reported = null;
        if (isset($obj->reported)) {
            $reported = $obj->reported;
        }

        $statue = $obj->statue;
        $badgeColorDefine = $this->reportDefine($statue, $reported);

        $reportTxtStatue = $this->getTheStatue($obj->statue);
        $reportTxt = $reported === '1' ? "Signalé" : $reportTxtStatue[0];
        return '<div class="badge badge-pill ' . $badgeColorDefine . '">' . $reportTxt . '</div>';
    }

    public function reportDefine($statue, $reported)
    {
        $finalClass = $this->getTheStatue($statue);
        return $reported === '1' ? $finalClass = 'badge-warning' : $finalClass[1];
    }

    protected function getTheStatue($statue)
    {
        switch ($statue) {
            case 1:
                return ['Publier', 'badge-success'];
                break;
            case 2:
                return ['A valider', 'badge-warning'];
                break;
            case 3:
                return ['Brouillon', 'badge-danger'];
                break;
            case 4:
                return ['Publier', 'badge-success'];
                break;
            case 5:
                return ['Ignorer', 'badge-danger'];
                break;
            case 6:
                return ['Nouveau', 'badge-primary'];
                break;
            default:
                return null;
        }
    }


}
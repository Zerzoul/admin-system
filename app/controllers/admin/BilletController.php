<?php

namespace controllers\admin;

class BilletController extends \framework\Controller
{

    const LIST_BILLET_PATH = '../app/view/admin/Billets/billets.php';
    protected $isIdNull = true;
    protected $id;

    public function displayAllBillet($isThrash)
    {
        $news = $this->app->getManager('billet');
        return $news->getListBillet($isThrash);
    }

    public function getTheBillet($id, $isThrash)
    {
        $news = $this->app->getManager('billet');
        $this->isIdNull = false;
        return $news->getTheBillet($id, $isThrash);
    }

    public function updateBillet($id, $title, $content, $imageId,$statue, $date)
    {
        $updateBillet = $this->app->getManager('billet');
        $updateBillet = $updateBillet->updateBillet($id, $title, $content, $imageId,$statue, $date);

        if ($updateBillet) {
            return true;
        } else {
            return $error = 'Une erreur c\'est prodduite. Votre billet n\'a pas pu être modifier';
        }
    }

    public function addBillet($title, $content, $imageId,$statue)
    {
        $addBillet = $this->app->getManager('billet');
        $addBillet = $addBillet->addBillet($title, $content, $imageId,$statue);

        if ($addBillet) {
            return true;
        } else {
            return $error = 'Une erreur c\'est prodduite. Votre billet n\'a pas pu être enregistrer';
        }
    }

    public function displayAllComments()
    {
        $news = $this->app->getManager('comments');
        return $news->getAllComments();
    }

    public function displayComment($id)
    {
        $this->isIdNull = false;
        $com = $this->app->getManager('comments');
        return $com->getComment($id);
    }

    public function updateStatueComment($id, $statue)
    {
        $com = $this->app->getManager('comments');
        return $com->updateStatueComment($id, $statue);
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
<?php


namespace controllers\admin;
require 'BilletController.php';

class EditBilletController extends BilletController
{

    protected $addBilletOnly = true;
    protected $buttonName = 'Enregistrer';

    protected $updateStatue = null;
    protected $updateTitle = null;
    protected $updatePost = null;
    protected $updateDate = null;

    public function billetForm()
    {
        $this->app->authAdmin();
        $id = $this->id;

        if (!is_null($id)) {
            $this->loadForUpdateBillet($id);
        }
        $addBilletOnly = $this->addBilletOnly;
        $statue = $this->updateStatue;

        $title = $this->form->input("text", "titleBillet", $this->updateTitle, "form-control", true);
        $titleLabel = $this->form->label("Titre :", "titleBillet");

        $contentBilletTextarea = $this->form->textarea("contentBillet", $this->updatePost);
        $submit = $this->form->submit($this->buttonName, "btn btn-info");

        require_once '../app/view/admin/Billets/addBillet.php';
    }

    public function loadForUpdateBillet($id)
    {
        $this->addBilletOnly = false;
        $this->buttonName = 'Modifier';
        $isThrash = 0;
        $updateBillet = $this->getTheBillet($id, $isThrash);
        if ($updateBillet->isThrash !== '0') {
            return;
        }

        $this->updateStatue = $updateBillet->statue;
        $this->updateTitle = $updateBillet->title;
        $this->updatePost = $updateBillet->content;
    }

    public function checkBillet()
    {
        $id = $this->id;
        if (!is_null($id)) {
            $this->addBilletOnly = false;
            $this->updateDate = date("Y-m-d H:i:s");
        }

        $title = $_POST['titleBillet'];
        $content = $_POST['contentBillet'];
        $statue = $_POST['statue'];

        if ($this->addBilletOnly) {
            $creatBillet = $this->addBillet($title, $content, $statue);
        } else {
            $creatBillet = $this->updateBillet($id, $title, $content, $statue, $this->updateDate);
        }

        if ($creatBillet) {
            header('Location: billets');
        }
    }


}
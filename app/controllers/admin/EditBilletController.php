<?php


namespace controllers\admin;
require 'BilletController.php';

class EditBilletController extends BilletController
{

    protected $addBilletOnly = true;
    protected $buttonName = 'Enregistrer';
    protected $imageId;

    protected $updateStatue = null;
    protected $updateTitle = null;
    protected $updatePost = null;
    protected $updateDate = null;
    protected $updatePhoto = null;

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

        $upload_photo_Label = $this->form->label("Upload :", "upload_image_billet");
        $upload_photo = $this->form->input("file", "upload_image_billet", $this->updatePhoto, "form-control", true);

        $contentBilletTextarea = $this->form->textarea("contentBillet", $this->updatePost);
        $submit = $this->form->submit($this->buttonName, "btn btn-success");

        $image = $this->updatePhoto;

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
        $this->updatePhoto = $updateBillet->file_id;
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


        $uploadImage = $this->app->upload($_FILES['upload_image_billet']);
        $this->imageId = $uploadImage->uploadImage();

        if ($this->addBilletOnly) {
            $creatBillet = $this->addBillet($title, $content, $this->imageId, $statue);
        } else {
            $creatBillet = $this->updateBillet($id, $title, $content, $this->imageId,$statue, $this->updateDate);
        }

        if ($creatBillet) {
            header('Location: billets');
        }
    }


}
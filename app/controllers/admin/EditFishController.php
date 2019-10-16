<?php

namespace controllers\admin;

use framework\Controller;

class EditFishController extends Controller
{
    protected $updateCategory = null;
    protected $updateCommuneName = null;
    protected $updateLatinName = null;
    protected $updateDetail = null;
    protected $updateRegime = null;
    protected $updateSize = null;
    protected $updateHeatMini = null;
    protected $updateHeatMax = null;
    protected $updatePH = null;
    protected $updateGH = null;
    protected $updateVolMini = null;
    protected $updateIndividualMini = null;
    protected $updatePhoto = null;
    protected $updatePrice = null;

    protected $buttonName = "Ajouter";
    protected $actionForm = "checkFish";

    public function fishForm(){

        if(isset($this->id)){
            $this->getTheFish($this->id);
            $this->buttonName = 'Modifier';
            $this->actionForm = 'checkFish-'.$this->id;
        }
        $category_Label = $this->form->label("Categorie :", "category");
        $category = $this->form->input("text", "category", $this->updateCategory, "form-control", true);

        $commun_name_Label = $this->form->label("Nom commun :", "commun_name");
        $commun_name = $this->form->input("text", "commun_name", $this->updateCommuneName, "form-control", true);

        $latin_name_Label = $this->form->label("Nom latin :", "latin_name");
        $latin_name = $this->form->input("text", "latin_name", $this->updateLatinName, "form-control", true);

        $regime_Label = $this->form->label("Régime alimentaire :", "regime");
        $regime = $this->form->input("text", "regime", $this->updateRegime, "form-control", true);

        $size_Label = $this->form->label("Taille :", "size");
        $size = $this->form->input("number", "size", $this->updateSize, "form-control", true);

        $heat_mini_Label = $this->form->label("Température mini:", "heat_mini");
        $heat_mini = $this->form->input("number", "heat_mini", $this->updateHeatMini, "form-control", true);

        $heat_max_Label = $this->form->label("Température max:", "heat_max");
        $heat_max = $this->form->input("number", "heat_max", $this->updateHeatMax, "form-control", true);

        $ph_Label = $this->form->label("PH :", "ph");
        $ph = $this->form->input("number", "ph", $this->updatePH, "form-control", true);

        $gh_Label = $this->form->label("GH :", "gh");
        $gh = $this->form->input("number", "gh", $this->updateGH, "form-control", true);

        $vol_mini_Label = $this->form->label("Volume minimum :", "vol_mini");
        $vol_mini = $this->form->input("number", "vol_mini", $this->updateVolMini, "form-control", true);

        $individual_mini_Label = $this->form->label("Minimum individu :", "individual_mini");
        $individual_mini = $this->form->input("number", "individual_mini", $this->updateIndividualMini, "form-control", true);

        $upload_photo_Label = $this->form->label("Upload :", "upload_photo");
        $upload_photo = $this->form->input("file", "upload_photo", $this->updatePhoto, "form-control", true);

        $price_Label = $this->form->label("Prix :", "price");
        $price = $this->form->input("number", "price", $this->updatePrice, "form-control", true);

        $contentDetailTextarea = $this->form->textarea("content_detail", $this->updateDetail);
        $submit = $this->form->submit($this->buttonName, "btn btn-info");

        $actionForm = $this->actionForm;

        $image = $this->updatePhoto;
        require_once '../app/view/admin/aqua-helper/fishForm.php';
    }
    public function getTheFish($id){
        $getTheFish = $this->app->getManager('aqua');
        $getTheFish = $getTheFish->getTheFish($id);
        $this->setTheFish($getTheFish);
    }
    public function setTheFish($getTheFish){

        $heat = explode('/', $getTheFish->heat);

        $this->updateCategory = $getTheFish->category_name;
        $this->updateCommuneName = $getTheFish->commun_name;
        $this->updateLatinName = $getTheFish->latin_name;
        $this->updateDetail = $getTheFish->detail;
        $this->updateRegime = $getTheFish->regime;
        $this->updateSize = $getTheFish->size;
        $this->updateHeatMini = $heat[0];
        $this->updateHeatMax = $heat[1];
        $this->updatePH = $getTheFish->PH;
        $this->updateGH = $getTheFish->GH;
        $this->updateVolMini = $getTheFish->vol_mini;
        $this->updateIndividualMini = $getTheFish->individual_mini;
        $this->updatePrice = $getTheFish->price;
        $this->updatePhoto = $getTheFish->file_id;
    }


}
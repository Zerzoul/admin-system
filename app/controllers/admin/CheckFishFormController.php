<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 04/10/2019
 * Time: 21:39
 */

namespace controllers\admin;
use framework\Controller;

class CheckFishFormController  extends Controller
{
    protected $imageId;
    protected $categoryId;

    public function checkFishForm(){
        $this->checkTheForm($_POST);
        $uploadImage = $this->app->upload($_FILES['upload_photo']);
        $this->imageId = $uploadImage->uploadImage();

        if(isset($this->imageId) && isset($this->categoryId)){
            $this->storeFish($_POST);
        };
    }
    public function checkTheForm($fishPost){

        foreach ($fishPost as $fishEntry){
            if(!isset($fishEntry)){
                return false;
            }
        }

        $aquaManager = $this->app->getManager('Aqua');
        $this->categoryId = $aquaManager->addCategory($fishPost['category']);

    }

    public function storeFish($fish){
        $aquaManager = $this->app->getManager('Aqua');
        $heat = $fish['heat_mini'].' / '.$fish['heat_max'];
        if(isset($this->id)){
            $fishStored = $aquaManager->updateFish($fish, $heat, $this->categoryId, $this->imageId, $this->id);
        } else {
            $fishStored = $aquaManager->addFish($fish, $heat, $this->categoryId, $this->imageId);
        }

        header('Location: fishlist');

    }
}
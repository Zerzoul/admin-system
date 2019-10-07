<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 04/10/2019
 * Time: 21:39
 */

namespace controllers\admin;
use framework\Controller;
use mysql_xdevapi\Exception;

class CheckFishFormController  extends Controller
{
    protected $imageId;
    protected $categoryId;

    public function checkFishForm(){
        $this->checkTheForm($_POST);
        $this->checkTheUploadedImage($_FILES['upload_photo']);

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
    public function checkTheUploadedImage($file){

        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg');


        if($fileError !== 0 && $fileSize > 1000000 && !in_array($fileActualExt, $allowedExt)){
            return false;
        }
        $fileId = uniqid('', false).'.'.$fileActualExt;
        $fileDestination = '../api/image_entity/'.$fileId;

        move_uploaded_file($fileTmp, $fileDestination);

        $systemManager = $this->app->getManager('System');
        $this->imageId = $systemManager->addImage($fileId);


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
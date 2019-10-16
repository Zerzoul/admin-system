<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 16/10/2019
 * Time: 09:51
 */

namespace framework;


class upload
{
    protected $fileName;
    protected $fileTmp;
    protected $fileError;
    protected $fileSize;

    public function __construct($file){
        var_dump($file);
        $this->fileName = $file['name'];
        $this->fileTmp = $file['tmp_name'];
        $this->fileError = $file['error'];
        $this->fileSize = $file['size'];
    }
    public function uploadImage(){

        $fileExt = explode('.', $this->fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg');

        if($this->fileError !== 0 && $this->fileSize > 1000000 && !in_array($fileActualExt, $allowedExt)){
            return false;
        }
        $fileId = uniqid('', false).'.'.$fileActualExt;
        $fileDestination = '../api/image_entity/'.$fileId;

        $transfertDone = move_uploaded_file($this->fileTmp, $fileDestination);

        if($transfertDone){
            $app = App::getInstance();
            $systemManager = $app->getManager('System');
            $imageId = $systemManager->addImage($fileId);

            return $imageId;
        }

    }
}
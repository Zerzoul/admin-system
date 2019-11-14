<?php
/**
 * Controle the upload from admin
 */

namespace framework;


class upload
{
    /**
     * @var
     */
    protected $fileName;
    /**
     * @var
     */
    protected $fileTmp;
    /**
     * @var
     */
    protected $fileError;
    /**
     * @var
     */
    protected $fileSize;

    /**
     * upload constructor.
     * @param $file
     */
    public function __construct($file){
        $this->fileName = $file['name'];
        $this->fileTmp = $file['tmp_name'];
        $this->fileError = $file['error'];
        $this->fileSize = $file['size'];
    }

    /**
     * Control all the information from $file and stock the new id into DB, the img goes into a folder in api
     * @return bool
     */
    public function uploadImage(){

        $fileExt = explode('.', $this->fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg');

        if($this->fileError !== 0 && $this->fileSize > 8000 && !in_array($fileActualExt, $allowedExt)){
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
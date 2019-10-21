<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 20/10/2019
 * Time: 18:24
 */

namespace controllers\api;


use framework\Controller;

class AuthentificationController extends Controller
{
    protected $email;
    protected $password;
    protected $user;
    protected $errorMessage = 'Mot de passe ou identifiant inconnue';

    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);
        $data = json_decode(file_get_contents("php://input"));

        $this->email = $data->email;
        $this->password = $data->password;
    }
    public function access(){
        try{
            $authValidation = $this->authValidation();
            if($authValidation){
                return $this->user->pseudo;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function authValidation(){
        $userManager = $this->app->getManager('users');
        $this->user = $userManager->getUser($this->email);

        if(isset($this->user)){
            $userPass = password_verify($this->password,$this->user->password);
            if($userPass){
                return true;
            }
        }
        throw new \Exception($this->errorMessage);
    }
}
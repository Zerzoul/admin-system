<?php
/**
 * Class UserController
 * controls the registration of a new member
 */

namespace controllers\api;
use framework\Controller;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    // user data
    protected $pseudo;
    protected $email;
    protected $password;

    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);
        $data = json_decode(file_get_contents("php://input"));

        $this->pseudo = $data->pseudo;
        $this->email = $data->email;
        $this->password = $data->password;
    }
    //Add the com if the validation return true
    public function registration(){
        $validaion = $this->checkValidation();
        if($validaion === true){
            $passHash = password_hash($this->password, PASSWORD_DEFAULT);
            $userManager = $this->app->getManager('users');
            $addUser = $userManager->addUser($this->pseudo, $passHash, $this->email);
        }
        return $validaion;
    }
    public function checkValidation(){
        try{
            $this->isPseudoExist();
            $this->isMailExist();

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function isPseudoExist(){
        $userManager = $this->app->getManager('users');
        $users = $userManager->getUsers();

        foreach ($users as $user){
            if(strtolower($user->pseudo) === strtolower($this->pseudo)){
                throw new \Exception('Se pseudo exist déja');
            } else {
                return true;
            }
        }
    }
    public function isMailExist(){
        $userManager = $this->app->getManager('users');
        $users = $userManager->getUsers();

        foreach ($users as $user){
            if($user->email === $this->email){
                throw new \Exception('Cette adresse mail existe déja');
            } else {
                return true;
            }
        }
    }
}
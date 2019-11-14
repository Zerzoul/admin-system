<?php
/**
 * Controller for the authentifacation API
 */

namespace controllers\api;


use framework\Controller;

class AuthentificationController extends Controller
{
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $errorMessage = 'Le mot de passe et l\'adresse mail ne correspondent pas.';

    /**
     * AuthentificationController constructor.
     * @param $app
     * @param $form
     * @param $params
     */
    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);
        $data = json_decode(file_get_contents("php://input"));

        $this->email = $data->email;
        $this->password = $data->password;
    }

    /**
     * method called from apiRoutes, return the name of the user from DB or error
     * @return object
     */
    public function access(){
        try{
            $authValidation = $this->authValidation();
            if($authValidation){
                return (object)array("pseudo" => $this->user->pseudo);
            }
        } catch (\Exception $e) {
            return (object)array("error" => $e->getMessage());
        }
    }

    /**
     * Called by acces controle information or return error message
     * @return bool
     * @throws \Exception
     */
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
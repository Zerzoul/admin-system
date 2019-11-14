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
    /**
     * @var
     */
    protected $pseudo;
    /**
     * @var
     */
    protected $email;
    /**
     * @var
     */
    protected $password;


    /**
     * UserController constructor
     * get all data passing through POST and set them.
     * @param $app
     * @param $form
     * @param $params
     */
    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);
        $data = json_decode(file_get_contents("php://input"));

        $this->pseudo = $data->pseudo;
        $this->email = $data->email;
        $this->password = $data->password;
    }

    /**
     * Add a new user if the validation is an empty array return true
     * @return array|bool
     */
    public function registration(){
        $validationPseudo = $this->checkValidationPseudo();
        $validationEmail = $this->checkValidationEmail();

        if($validationEmail === true && $validationPseudo === true){

            $passHash = password_hash($this->password, PASSWORD_DEFAULT);
            $userManager = $this->app->getManager('users');
            $userManager->addUser($this->pseudo, $passHash, $this->email);

            return true;
        }
        return (object)array(
            'errorPseudo' => $validationPseudo === true ? null : $validationPseudo,
            'errorEmail' => $validationEmail === true ? null : $validationEmail,
        );
    }

    /**
     * Execute methods and catch error for validation pseudo
     * @return bool
     */
    public function checkValidationPseudo(){
        try{
            $this->isPseudoExist();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
    /**
     * Execute methods and catch error for validation email
     * @return bool
     */
    public function checkValidationEmail(){
        try{
            $this->isMailExist();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return true;
    }

    /**
     * Check if pseudo exist in the db
     * @throws \Exception
     */
    public function isPseudoExist(){
        $userManager = $this->app->getManager('users');
        $users = $userManager->getUsers();

        foreach ($users as $user){
            if(strtolower($user->pseudo) === strtolower($this->pseudo)){
                throw new \Exception('Se pseudo est déja pris');
            }
        }
    }

    /**
     * Check is email exist in the db
     * @throws \Exception
     */
    public function isMailExist(){
        $userManager = $this->app->getManager('users');
        $users = $userManager->getUsers();

        foreach ($users as $user){
            if($user->email === $this->email){
                throw new \Exception('Cette adresse mail existe déja');
            }
        }
    }
}
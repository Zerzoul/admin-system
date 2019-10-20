<?php
/**
 * Class UserController
 * controls the registration of a new member
 */

namespace controllers\api;
use framework\Controller;
class UserController extends Controller
{
    // user data
    protected $pseudo;
    protected $email;
    protected $password;

    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);

        // store all the information we need about the comment
        $data = json_decode(file_get_contents("php://input"));
        $this->pseudo = $data->pseudo;
        $this->email = $data->email;
        $this->password = $data->password;
    }
    //Add the com if the validation return true
    public function registration(){
        $validation = $this->commentsValidation();
        if(!$validation){
            return false;
        }
        $addCom = $this->app->getManager('Comments');
        $response = $addCom->addComs($this->postId, $this->answerPostId, $this->author, $this->content);
        if($response){
            return true;
        }
    }
}
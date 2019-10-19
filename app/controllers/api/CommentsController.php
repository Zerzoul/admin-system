<?php
/**
 * Class CommentController
 * controls all about comments adding, updating, deleting
 */

namespace controllers\api;
use framework\Controller;
class CommentsController extends Controller
{
    // comment's data
    protected $postId; // Id of the billet post
    protected $answerPostId; // Id of the comment if it get an answer
    protected $author; // The author of the comment
    protected $content; // The comment content

    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);

        // store all the information we need about the comment
        $data = json_decode(file_get_contents("php://input"));
        $this->postId = $data->postId;
        $this->answerPostId = $data->answerPostId;
        $this->author = htmlspecialchars($data->author);
        $this->content = htmlspecialchars($data->content);
    }
    //Add the com if the validation return true
    public function addCom(){
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
    // Check the backend side
    public function commentsValidation(){
        // is the billet exist ?
        $post = $addCom = $this->app->getManager('Billet');
        $postExist = $post->getTheBillet($this->postId, 0);
        if(!$postExist){
            return false;
        }
        // if is an answer, is the comment exist ?
        if(isset($this->answerPostId)){
            $comment = $addCom = $this->app->getManager('Comments');
            $postExist = $comment->getComment($this->answerPostId);
            if(!$postExist){
                return false;
            }
        }
        return true;
    }
}
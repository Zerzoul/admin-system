<?php
/**
 * Class CommentController
 * controls all about comments adding, updating, deleting
 */

namespace controllers\api;
use framework\Controller;
class CommentsController extends Controller
{
    /**
     * Content post Id, the comment will be attche to it
     * @var number|null
     */
    protected $postId = null;
    /**
     * if it's an answer to a comment
     * @var number|null
     */
    protected $answerCommentId = null;
    /**
     * Author of the comment
     * @var string|null
     */
    protected $author = null;
    /**
     * content comment
     * @var string|null
     */
    protected $content = null; // The comment content

    /**
     * CommentsController constructor.
     * @param $app
     * @param $form
     * @param $params
     */
    public function __construct($app, $form, $params)
    {
        parent::__construct($app, $form, $params);

        // store all the information we need about the comment
        $request = $_SERVER['REQUEST_METHOD'];
        $data = json_decode(file_get_contents("php://input"));
        if(isset($data) && $request === 'POST'){
            $this->postId = $data->postId;
            $this->answerCommentId = $data->answerCommentId;
            $this->author = htmlspecialchars($data->author);
            $this->content = htmlspecialchars($data->content);
        }
    }

    /**
     * Add the comment if the validation return true
     * @return array|object
     */
    public function addCom(){
        $validation = $this->commentsValidation();
        if(!$validation[0]){
            return $validation;
        }
        $addCom = $this->app->getManager('Comments');
        $dataResponse = $addCom->addComs($this->postId, $this->answerCommentId, $this->author, $this->content);
        if ($dataResponse) {
            $response =
                (object)array(
                    "id" => $dataResponse[0],
                    "postId" => $this->postId,
                    "answerCommentId" => $this->answerCommentId,
                    "author" => $this->author,
                    "content" => $this->content,
                    "date" => $dataResponse[1],
                );
            return $response;
        }
    }

    /**
     * Check the backend side
     * @return array
     */
    public function commentsValidation(){
        // is the billet exist ?
        $post = $this->app->getManager('Billet');
        $postExist = $post->getTheBillet($this->postId, "0");
        if(!$postExist){
            return [false, 'Le post n\'éxiste pas'];
        }
        // if is an answer, is the comment exist ?
        if(!is_null($this->answerCommentId)){
            $comment = $addCom = $this->app->getManager('Comments');
            $answerExist = $comment->getComment($this->answerCommentId);
            if(!$answerExist){
                return [false, 'La réponse n\'éxiste pas'];
            }
        }
        return [true];
    }

    /**
     * Get all comments from DB
     * @return mixed
     */
    public function getComments(){
        $commentsManager = $this->app->getManager('Comments');
        return $commentsManager->getAllComments();
    }
}
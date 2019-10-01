<?php

namespace controllers\home;

use mysql_xdevapi\Exception;

class CommentsController extends \framework\Controller
{

    protected $validator = 'ContentValidator.php';

    public function getCountCom($table, $id)
    {
        $coms = $this->app->getManager('comments');
        $coms = $coms->countComs($table, $id);
        return $coms;
    }

    public function getComs()
    {
        //TODO: fetch tous les commentaires liées à l'id du post
        $table = $this->selectTableComments(null);
        $coms = $this->app->getManager('comments');
        $coms = $coms->getComments($table, $this->id);
        return $coms;
    }

    public function addComment()
    {
        require $this->validator;
        $id = $this->id;
        $type = $this->type;

        $mail = isset($_SESSION['userMail']) ? $_SESSION['userMail'] : $_POST['email'];

        $validator = new ContentValidator();
        $email = $validator->emailContent($mail);
        $comments = $validator->commentsContent($_POST['postComment']);

        $users = $this->app->getController('users', 'home', null);
        $author = isset($_SESSION['userName']) ? $_SESSION['userName'] : $users->getUser($email);

        $coms = $this->app->getManager('comments');

        $table = $this->selectTableComments($type === 'chapitre' ? 'episodes' : $type);
        $coms->addComs($table, $id, $author, $comments);

        header('location: ' . $type . '-' . $this->urlEncode($this->id));
    }

    public function report()
    {
        $type = $this->type === 'chapitre' ? 'episodes' : $this->type;
        $table = $this->selectTableComments($type);
        $coms = $this->app->getManager('comments');
        $id_post = urldecode($_POST['idCom']);
        $report = $coms->reportCom($table, base64_decode($id_post), 1);
        if (!$report) {
            throw new \Exception('The reported can\'t be executed');
        }

        header('location: ' . $this->type . '-' . $this->urlEncode($this->id));
    }

}
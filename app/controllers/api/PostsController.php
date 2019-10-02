<?php
/**
 * Created by PhpStorm.
 * User: Zerzoul
 * Date: 01/10/2019
 * Time: 21:47
 */
namespace controllers\api;

class PostsController extends \framework\Controller
{
    public function listPosts(){
        $posts = $this->app->getManager('billet');
        $posts = $posts->getListPost('ASC');
        return $posts;
    }

}
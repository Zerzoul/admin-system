<?php
/**
 * return all post data
 */
namespace controllers\api;

class PostsController extends \framework\Controller
{
    // return all post data
    public function listPosts(){
        $posts = $this->app->getManager('billet');
        $posts = $posts->getListPost('DESC');
        return $posts;
    }

}
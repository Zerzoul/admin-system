<?php

namespace controllers\admin;

use framework\Controller;

class DashboardController extends Controller
{
    protected $countnewCom;
    protected $countBillet;

    public function dashboard()
    {
        $this->app->authAdmin();
        $billet = $this->app->getManager('news');
        $billetRough = $billet->getCountBillet('0', 3);
        $billetToValidate = $billet->getCountBillet('0', 2);
        $billetPublished = $billet->getCountBillet('0', 1);

        $comment = $this->app->getManager('comments');
        $newComment = $comment->getCountComment('statue', 6);
        $reportedComment = $comment->getCountComment('reported', '1');

        require '../app/view/admin/Dashboard/dashboard.php';
    }
}
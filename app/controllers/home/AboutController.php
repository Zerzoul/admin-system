<?php

namespace controllers\home;

class AboutController extends \framework\Controller
{


    public function getAboutPage()
    {
        require 'app/view/home/About/about.php';
    }

}

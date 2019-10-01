<?php

namespace controllers\home;

class EpisodesController extends \framework\Controller
{


    public function listChapter()
    {
        $table = $this->selectTable($this->path);
        $episode = $this->app->getManager('news');
        $episodes = $episode->getListNews($table, 'ASC');

        require 'app/view/home/Episodes/episodes.php';
    }

    public function chapter()
    {
        if (is_null($this->id) || $this->id === 0) {
            header('Location: episodes');
            exit();
        }
        $table = $this->selectTable('episodes');
        $tableComs = $this->selectTableComments('episodes');

        $chapter = $this->app->getManager('news');
        $chapter = $chapter->getTheNews($table, $this->id);
        $chapter;
        $coms = $this->app->getController('comments', 'home', null);
        $comCount = $coms->getCountCom($tableComs, $this->id);
        $comCount;
        $coms = $this->app->getManager('comments');
        $coms = $coms->getComments($tableComs, $this->id);

        $coms;

        require 'app/view/home/Episodes/episode.php';
    }

}

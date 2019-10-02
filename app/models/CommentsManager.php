<?php

namespace models;

use \framework\Manager;

class CommentsManager extends Manager
{


    public function getComments($table, $post_id)
    {
        $getComs = $this->pdo->prepare('SELECT id, post_id, author, comments, date FROM ' . $table . ' WHERE (post_id = :post_id) AND (statue = ' . parent::COM_VALID . ' OR statue = ' . parent::COM_NEW . ')');
        $getComs->execute(array('post_id' => $post_id));
        $dataComs = $getComs->fetchAll(\PDO::FETCH_OBJ);
        return $dataComs;
    }

    public function countComs($table, $id)
    {
        $getComs = $this->pdo->prepare('SELECT COUNT(*) AS counts FROM ' . $table . ' WHERE post_id = :post_id AND (statue = ' . parent::COM_VALID . ' OR statue = ' . parent::COM_NEW . ')');
        $getComs->execute(array('post_id' => $id));
        $dataComs = $getComs->fetch(\PDO::FETCH_LAZY);
        return $dataComs;
    }

    public function addComs($table, $id, $author, $comments)
    {
        $addComs = $this->pdo->prepare('INSERT INTO ' . $table . '(post_id, author, comments, statue) VALUES (:post_id, :author, :comments, :statue)');
        $addComs->execute(array(
            'post_id' => $id,
            'author' => $author,
            'comments' => $comments,
            'statue' => parent::COM_NEW,
        ));
        return $addComs;
    }

    public function reportCom($table, $id, $report)
    {
        $reportUpdate = $this->pdo->prepare('UPDATE ' . $table . ' SET reported = :reported WHERE id = :id');
        $reportUpdate = $reportUpdate->execute(array(
            'reported' => $report,
            'id' => $id
        ));
        return $reportUpdate;
    }

    // ADMIN
    public function getAllComments($tableCom, $tablePost)
    {
        $getComs = $this->pdo->query('SELECT tC.id, tP.title, tC.author, tC.comments, tC.date, tC.post_id, tC.statue, tC.reported FROM ' . $tableCom . ' tC LEFT JOIN ' . $tablePost . ' tP ON tC.post_id = tP.id GROUP BY tC.id ');
        $dataComs = $getComs->fetchAll(\PDO::FETCH_OBJ);
        return $dataComs;
    }

    public function getComment($tableCom, $tablePost, $id)
    {
        $getCom = $this->pdo->prepare('SELECT tC.id, tP.title, tC.author, tC.comments, tC.date, tC.post_id, tC.statue, tC.reported FROM ' . $tableCom . ' tC LEFT JOIN ' . $tablePost . ' tP ON tC.post_id = tP.id WHERE tC.id = :id GROUP BY tC.id');
        $getCom->execute(array(
            'id' => $id
        ));
        $dataCom = $getCom->fetch(\PDO::FETCH_LAZY);
        return $dataCom;
    }

    public function updateStatueComment($tableCom, $id, $statue)
    {
        $updateStatueCom = $this->pdo->prepare('UPDATE ' . $tableCom . ' SET statue = :statue, reported = :reported WHERE id = :id ');
        $updateStatueCom = $updateStatueCom->execute(array(
            'id' => $id,
            'reported' => 0,
            'statue' => $statue
        ));
        return $updateStatueCom;
    }

    public function updateAuthorComment($oldName, $newName)
    {
        var_dump($oldName, $newName);
        $updateAuthorComment = $this->pdo->prepare('UPDATE newscomments, episodescomments SET newscomments.author = :newsAuthor, episodescomments.author = :newsAuthor WHERE newscomments.author = :oldAuthor  OR episodescomments.author=:oldAuthor ');
        $updateAuthorComment = $updateAuthorComment->execute(array(
            'newsAuthor' => $newName,
            'oldAuthor' => $oldName,

        ));
        return $updateAuthorComment;
    }

    public function getCountComment($requete, $reported)
    {
        $getCountComment = $this->pdo->prepare('SELECT COUNT(id) AS commentCount FROM comment WHERE '. $requete .'=:'. $requete .' ');
        $getCountComment->execute(array($requete => $reported));
        $getCountComment = $getCountComment->fetch(\PDO::FETCH_LAZY);
        return $getCountComment;
    }
}


<?php

namespace App\models;


class Commentaries extends Model
{

    public function findAllCommentsByPost(int $article_id) : array
    {
        
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaries = $query->fetchAll();
    
        return $commentaries;
    }

    public function findComment(int $id) 
    {
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment = $query->fetch();
    
        return $comment;
    }
    
    public function deleteComment(int $id) : void
    {
        $query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }
    
    public function insertComment(string $author, string $content, int $article_id ) : void
    {    
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }

}
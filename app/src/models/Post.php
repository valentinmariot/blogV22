<?php

namespace App\models;


class Post extends Model
{

    public function findAllPosts() : array
    {
        $resultats = $this->pdo->query("SELECT * FROM `articles` ORDER BY `created_at` DESC");
        $posts = $resultats->fetchAll();

        return $posts;
    }

    public function findPost(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `articles` WHERE id = :article_id");
        $query->execute(['article_id' => $id]);
        $post = $query->fetch();
        
        return $post;
    }

    public function deletePost(int $id) : void
    {
        $query = $this->pdo->prepare("DELETE FROM `articles` WHERE id = :id");
        $query->execute(['id' => $id]);
    }

}
<?php

namespace App\controllers;

use App\fram\Http;

class CommentaryController extends Controller
{
    protected $modelName = \App\models\Commentaries::class;

    public function insert()
    {
        // creer un nouveau commentaire
        $postModel = new \App\models\Post;

        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        $content = null;
        if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
        }

        $post_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $post_id = $_POST['article_id'];
        }
        if (!$author || !$post_id || !$content) {
            var_dump($author, $post_id, $content);
            die("Votre formulaire a été mal rempli !");
        }

        $postModel = new \App\models\Post;

        $post = $postModel->findPost($post_id);

        if (!$post) {
            die("Ho ! L'article $post_id n'existe pas boloss !");
        }

        $this->model->insertComment($author, $content, $post_id);

        Http::redirect("index.php?controller=postController&task=show&id=" . $post_id);
    }

    public function delete()
    {

        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }
        
        $id = $_GET['id'];
         
        $commentary = $this->model->findComment($id);
        if (!$commentary) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }
        $this->model->deleteComment($id);
        
        $post_id = $commentary['article_id'];
                    
        Http::redirect("index.php?controller=postController&task=show&id=" . $post_id);
    }
}
<?php

namespace App\controllers;

use App\fram\Http;
use App\fram\Renderer;

class PostController extends Controller
{

    protected $modelName = \App\models\Post::class;

    public function index()
    {

        $posts = $this->model->findAllPosts();

        
        $pageTitle = "Accueil";

        Renderer::render('posts/index', compact('pageTitle', 'posts'));
    }

    public function show()
    {

        $post_id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $post_id = $_GET['id'];
        }
        
        if (!$post_id) {
            die("Manque `id` dans l'URL !!!!");
        }
                   
        
        $post = $this->model->findPost($post_id);
        
        $commentariesModel = new \App\models\Commentaries();
        $commentaries =  $commentariesModel->findAllCommentsByPost($post_id);
                
         $pageTitle = $post['title'];        
        
        Renderer::render('posts/show', compact('pageTitle', 'post', 'commentaries', 'post_id'));
    }

    public function delete()
    {
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("L'id n'a pas été spécifié");
        }

        $id = $_GET['id'];
        $posts = $this->model->findPost($id);
        if (!$posts) {
            die("L'article $id n'existe pas.");
        }

        $this->model->deletePost($id);

        Http::redirect('index.php');
    }
}
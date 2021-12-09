<h1 class="text-success">Nos articles</h1>

<?php foreach ($posts as $post) : ?>
    <div class="card mb-12 border-success">
        <h2 class="card-header"><?= $post['title'] ?></h2>
        <small class="text-grey">Ecrit le : <?= $post['created_at'] ?></small>
        <div class="card-body">
            <p class="card-text"><?= $post['introduction'] ?></p>
        </div>
        <div class="card-body">
            <a href="index.php?controller=postController&task=show&id=<?= $post['id'] ?>" class="card-link">Lire la suite</a>
            <a class="card-link" href="index.php?controller=postController&task=delete&id=<?= $post['id'] ?>" onclick="return window.confirm(`Supprimer l'article : <?= $post['title'] ?> ?`)">Supprimer</a>
        </div>
    </div>
    <br>

<?php endforeach ?>

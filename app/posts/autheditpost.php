<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

//Updates user posts in the database
if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {
    $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
    $link = filter_var(trim($_POST['link']), FILTER_SANITIZE_URL);
    $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
    //$entry_id = filter_var($_POST['entry_id'], FILTER_SANITIZE_NUMBER_INT);

    $updatePost = $pdo->prepare("UPDATE Entry SET title = :title, link = :link, description = :description WHERE entry_id = :id");

    if (!$updatePost) {
      die(var_dump($pdo->errorInfo()));
    }


    $updatePost->bindParam(':title', $title, PDO::PARAM_STR);
    $updatePost->bindParam(':link', $link, PDO::PARAM_STR);
    $updatePost->bindParam(':description', $description, PDO::PARAM_STR);
    $updatePost->bindParam(':id', $_POST['id'], PDO::PARAM_INT); //ny med id
    $updatePost->execute();
}

redirect('../../userposts.php');

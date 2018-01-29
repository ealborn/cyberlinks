<?php
require __DIR__.'/../autoload.php';

//Updates user posts in the database
if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $entry_id = filter_var($_POST['entry_id'], FILTER_SANITIZE_NUMBER_INT);

    $updatePost = $pdo->prepare("UPDATE Entry SET title = :title, link = :link, description = :description WHERE entry_id = :id");

    $updatePost->bindParam(':title', $title, PDO::PARAM_STR);
    $updatePost->bindParam(':link', $link, PDO::PARAM_STR);
    $updatePost->bindParam(':description', $description, PDO::PARAM_STR);
    $updatePost->bindParam(':id', $entry_id, PDO::PARAM_INT);
    $updatePost->execute();
        if (!$updatePost) {
            die(var_dump($pdo->errorInfo()));
        }
}
redirect('/addpost.php');

<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we add and store new posts in the database.

if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {

  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

  $postdate = date('F j, Y, g:i a');
  $poster = $_SESSION['userSession']['username'];

  $addPost = $pdo->prepare('INSERT INTO Entry (title, link, description, post_date, poster) VALUES (:title, :link, :description, :post_date, :poster)');

  $addPost->bindParam(':title', $title, PDO::PARAM_STR);
    $addPost->bindParam(':link', $link, PDO::PARAM_STR);
    $addPost->bindParam(':description', $description, PDO::PARAM_STR);
    $addPost->bindParam(':post_date', $postdate, PDO::PARAM_STR);
    $addPost->bindParam(':poster', $poster, PDO::PARAM_STR);
    $addPost->execute();

    if (!$addPost) {
            die(var_dump($pdo->errorInfo()));
        }

}
//redirect('/');


// get all posts from database
$statement = $pdo->prepare('SELECT * FROM Entry JOIN User ON Entry.poster=User.username ORDER BY post_date DESC');
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

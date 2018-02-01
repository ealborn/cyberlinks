<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$userSession = $_SESSION['userSession'] ?? false;

// In this file we delete posts from the database.

//delete votes associated with the entry_id
$deletePost = $pdo->prepare("DELETE FROM Votes WHERE vote_id = :vote_id");
$deletePost->bindParam(':vote_id', $_POST['entry_id'], PDO::PARAM_INT);
$deletePost->execute();
if (!$deletePost) {
    die(var_dump($pdo->errorInfo()));
}
//delete the entry
$deletePost = $pdo->prepare("DELETE FROM Entry WHERE entry_id = :entry_id");
$deletePost->bindParam(':entry_id', $_POST['entry_id'], PDO::PARAM_INT);
$deletePost->execute();

if (!$deletePost) {
    die(var_dump($pdo->errorInfo()));
}

$pdo->errorInfo();

redirect('../../userposts.php');

<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

// In this file we add new posts into the database.

if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {

  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $postdate = date('F j, Y, g:i a');
  $poster = $_SESSION['userSession']['username'];

  $addPost = $pdo->prepare("INSERT INTO Entry (title, link, description, post_date, poster) VALUES (:title, :link, :description, :post_date, :poster)");

  $addPost->bindParam(':title', $title, PDO::PARAM_STR);
  $addPost->bindParam(':link', $link, PDO::PARAM_STR);
  $addPost->bindParam(':description', $description, PDO::PARAM_STR);
  $addPost->bindParam(':post_date', $postdate, PDO::PARAM_STR);
  $addPost->bindParam(':poster', $poster, PDO::PARAM_STR);
  $addPost->execute();

  if (!$addPost) {
    die(var_dump($pdo->errorInfo()));
  }
} //end if statement.

  // get all posts from database
  // $statement = $pdo->prepare('SELECT * FROM Entry JOIN User ON Entry.poster=User.username ORDER BY post_date DESC');
  // //kolla om denna kan vara bara select all from entry?
  // $statement->execute();
  // $results = $statement->fetchAll(PDO::FETCH_ASSOC);

$voteId = $pdo->lastInsertId(); //inserts the ID of the latest post submitted
$score = 0; //set score to 0 to start with.
//insert score 0 and vote ID into the table Votes.
$statement = $pdo->prepare('INSERT INTO Votes (score, vote_id) VALUES(:score, :vote_id)');
$statement->bindParam(':score', $score, PDO::PARAM_INT);
$statement->bindParam(':vote_id', $voteId, PDO::PARAM_INT);
$statement->execute();

redirect('/'); //go to index page to view post.

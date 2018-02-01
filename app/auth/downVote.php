<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

// database connection to update downvote on entry
if (isset($_POST['downvote'], $_POST['entry_id'])) {
  $voteUp = $pdo->prepare("UPDATE Votes SET score = :newscore WHERE vote_id = :entry_id");
  $voteUp->bindParam(':entry_id', $_POST['entry_id'], PDO::PARAM_INT);
  $voteUp->bindParam(':newscore', $_POST['downvote'], PDO::PARAM_INT);
  $voteUp->execute();
  $vote = $voteUp->fetch(PDO::FETCH_ASSOC);

  if (!$voteUp) {
    die(var_dump($pdo->errorInfo()));
  } else {
    redirect('/');
  }
}

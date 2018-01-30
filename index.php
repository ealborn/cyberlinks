<?php
require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$userSession = $_SESSION['userSession'] ?? false;
?>

<article>
  <h1><?php echo $config['title']; ?></h1>
  <p>A link-posting-community.</p>

  <?php if ($message !== ''): ?>
    <p><?php echo $message; ?></p>
  <?php endif; ?>
</article>


<div class="row">

  <?php

  // $getVotes =$pdo->prepare('SELECT score FROM Votes WHERE vote_id=:vote_id');
  // $getVotes->bindParam(':vote_id', $userSession['user_id'], PDO::PARAM_INT);
  // $getVotes->execute();
  // $getVotes = $getVotes->fetchAll(PDO::FETCH_ASSOC);
  //
  // var_dump($getVotes);

  // Ny test
  //$stmt = $pdo->prepare('SELECT title, description, link, post_date FROM Entry');
  $stmt = $pdo->prepare('SELECT Entry.*, User.user_id, User.username, User.avatar, Votes.* FROM Entry JOIN User ON Entry.poster=User.username JOIN Votes ON Votes.vote_id=Entry.entry_id');
  $stmt->execute();
  $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($entries as $entry) {
    $title = $entry['title'];
    $link = $entry['link'];
    $description = $entry['description'];
    $post_date = $entry['post_date'];
    $score = $entry['score'] ?>


    <div class="col-6 offset-3">
      <div class="row">
        <h3 class="col-12"><?php echo $title ?></h3>
        <p class="col-12"><?php echo $link ?></p>
      </div>
      <div class="row">
        <p class="col-12"><?php echo $description ?></p>
        <span class="col-12"><?php echo $post_date ?></span>
      </div>
      <form class="" action="index.html" method="post">
        <input type="text" name="entry_id" value="<?php echo $entry['user_id']; ?>">
        <input type="text" name="upvote" value="<?php echo $entry['score']; ?>">
        <button type="button" name="upv">vote up</button>
      </form>
      <form class="" action="index.html" method="post">
        <input type="text" name="entry_id" value="<?php echo $entry['user_id']; ?>">
        <input type="text" name="downvote" value="<?php echo $entry['score']; ?>">
        <button type="button" name="downv">vote down</button>
      </form>
    </div>
    <?php
  }//end foreach?>

</div>



<?php if (isset($_SESSION['userSession'])) {
  require __DIR__.'/newpost.php';
} else {
  echo "You need to log in first.";?>
  <a href="/register.php">Log in</a>
  <?php
}

require __DIR__.'/views/footer.php';
?>
</div>

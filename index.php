<?php
declare(strict_types=1);
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

  <?php //display all user eposts(entries), the author and voting scores, ordered by vote score in descending order.
  $stmt = $pdo->prepare("SELECT Entry.*, User.user_id, User.username, User.avatar, Votes.* FROM Entry JOIN User ON Entry.poster=User.username JOIN Votes ON Votes.vote_id=Entry.entry_id ORDER BY score DESC");
  $stmt->execute();
  $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($entries as $entry) { //start foreach
    $title = $entry['title'];
    $link = $entry['link'];
    $description = $entry['description'];
    $post_date = $entry['post_date'];
    $score = $entry['score'] ?>

<!-- displays all user posts made  -->
<div class="card">
  <div class="card-body">
      <div class="row">
        <h3 class="card-header col-12"><?php echo $title ?></h3>
        <!-- <h5 class="col-12"><?php echo $title; ?></h5> -->
        <h5 class="col-12"><a href="<?php echo $link; ?>" target="_blank"> <?php echo $entry['link']; ?></a></h5>
        <h6 class="col-12"><?php echo $description ?></h6>
        <h6 class="col-12"><?php echo $post_date ?></h6>
        <p class="col-12"><?php echo "Votes: ".$entry['score']?></p>
      </div>
      <div class="col-12">
        <div class="row">
          <form action="/app/auth/upVote.php" method="post">
            <input type="hidden" name="entry_id" value="<?php echo $entry['entry_id']; ?>">
            <input type="hidden" name="upvote" value="<?php echo $entry['score']+1; ?>">
            <button type="submit" class="badge badge-pill badge-success" name="upv">Vote up</button>
          </form>
          <form action="/app/auth/downVote.php" method="post">
            <input type="hidden" name="entry_id" value="<?php echo $entry['entry_id']; ?>">
            <input type="hidden" name="downvote" value="<?php echo $entry['score']-1; ?>">
            <button type="submit" class="badge badge-pill badge-danger" name="downv">Vote down</button>
          </form>
        </div>
      </div>
  </div>
</div>
  <?php
  }//end foreach?>
</div>


<?php if (isset($_SESSION['userSession'])) {
  require __DIR__.'/newpost.php';
} else {
  echo "You need to log in to post.";?>
  <a href="/login.php">Log in here</a>
  <?php
}

require __DIR__.'/views/footer.php';
?>
<a href="https://www.flaticon.com/search?word=chevron">Icons by Chevron on Flaticon</a>
</div>

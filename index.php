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
    $score = $entry['score'];
    $avatar = $entry['avatar'];
    $username = $entry['username'];?>

<!-- displays all posts made  -->
  <div class="card">
    <div class="card-body">

        <div class="card-header row">
          <div class="col-6">
            <h3 class=""><?php echo $title ?></h3>
          </div>

          <div class="col">
            <img src="uploads/<?php echo $avatar; ?>" class="img-thumbnail mini float-right">
            <p class=""><?php echo "Posted by ".$username. " on ".$post_date; ?></p>
          </div>

        </div>

          <h5 class="col-6"><a href="<?php echo $link; ?>" target="_blank"> <?php echo $entry['link']; ?></a></h5>
          <h6 class="col-6"><?php echo $description ?></h6>
          <p class="col-6"><?php echo "Votes: ".$entry['score']?></p>


          <div class="container">
            <div class="row col-6">
              <form action="/app/auth/upVote.php" method="post">
                <input type="hidden" name="entry_id" value="<?php echo $entry['entry_id']; ?>">
                <input type="hidden" name="upvote" value="<?php echo $entry['score']+1; ?>">
                <button type="submit" class="badge badge-pill badge-success" name="upv">Vote up</button>
              </form>
            </div>

            <div class="row col-6">
              <form action="/app/auth/downVote.php" method="post">
                <input type="hidden" name="entry_id" value="<?php echo $entry['entry_id']; ?>">
                <input type="hidden" name="downvote" value="<?php echo $entry['score']-1; ?>">
                <button type="submit" class="badge badge-pill badge-danger" name="downv">Vote down</button>
              </form>
            </div>
          </div> <!-- /container -->

      </div> <!-- /card body -->
  </div> <!-- /card -->
  <?php
}//end foreach
?>


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

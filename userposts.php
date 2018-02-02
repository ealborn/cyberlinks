<?php
require __DIR__.'/views/header.php';
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$userSession = $_SESSION['userSession'] ?? false;
// prepare database request to fetch users entries(posts) for the logged in user
$userPosts = $pdo->prepare("SELECT * from Entry JOIN Votes ON Votes.vote_id=Entry.entry_id WHERE Entry.poster=:userSession");
$userPosts->bindParam(':userSession', $userSession['username'], PDO::PARAM_STR);
$userPosts->execute();
$links = $userPosts->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
  <div class="card-body">
    <?php
        // fetch each user post link, title, who posted and description and add buttons
        //to delete and edit
        foreach($links as $link): ?>
          <h3 class="col-12"><?php echo $link['title'] ?></h3>
          <h5 class="col-12"><?php echo $link['link'] ?></h5>
          <p class="col-12"><?php echo $link['description'] ?></p>

          <form class="col-12" action="editposts.php" method="post">
            <input type="hidden" name="entry_id" value="<?php echo $link['entry_id'] ?>">
            <button class="btn btn-primary" type="submit" name="button">Edit post</button>
          </form>
          <form class="col-12" action="/app/posts/deletepost.php" method="post">
            <input type="hidden" name="entry_id" value="<?php echo $link['entry_id'] ?>">
            <button class="btn btn-danger" type="submit" name="button">Delete</button>
          </form>
        <?php
      endforeach;
      ?>
  </div>
</div>

<?php if ($links == NULL) : ?>
<?php require __DIR__.'/newpost.php'; ?>
<?php endif; ?>

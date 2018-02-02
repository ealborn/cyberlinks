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

// fetch each user post link, title, who posted and description and add buttons
//to delete and edit
foreach($links as $link): ?>
  <h1><?php echo $link['title'] ?></h1>
  <p><?php echo $link['link'] ?></p>
  <p><?php echo $link['poster'] ?></p>
  <p><?php echo $link['description'] ?></p>
  <form action="editposts.php" method="post">
    <input type="hidden" name="entry_id" value="<?php echo $link['entry_id'] ?>">
    <button type="submit" name="button">Edit post</button>
  </form>
  <form action="/app/posts/deletepost.php" method="post">
    <input type="hidden" name="entry_id" value="<?php echo $link['entry_id'] ?>">
    <button type="submit" name="button">Delete</button>
  </form>
<?php endforeach; ?>

<?php if ($links == NULL) : ?>
<?php require __DIR__.'/newpost.php'; ?>
<?php endif; ?>

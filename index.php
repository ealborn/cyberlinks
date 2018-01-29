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
  // Ny test
  $stmt = $pdo->prepare('SELECT title, description, link, post_date FROM Entry');
  $stmt->execute();
  $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($entries as $entry) {
    $title = $entry['title'];
    $link = $entry['link'];
    $description = $entry['description'];
    $post_date = $entry['post_date'];?>


    <div class="col-6 offset-3">
      <div class="row">
        <h3 class="col-12"><?php echo $title ?></h3>
        <p class="col-12"><?php echo $link ?></p>
      </div>
      <div class="row">
        <p class="col-12"><?php echo $description ?></p>
        <span class="col-12"><?php echo $post_date ?></span>
      </div>
    </div>
    <?php
  }?>

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

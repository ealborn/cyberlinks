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


<div class="row pt-5 justify-content-center">

  <?php
// Ny test
$stmt = $pdo->prepare('SELECT title, description, link, post_date FROM Entry');
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($entries as $entry) {
  $title = $entry['title'];
  $link = $entry['link'];
  $description = $entry['description'];
  $post_date = $entry['post_date'];

  //echo $title.' '.$link.' '.$description.' '.$post_date;
}?>

<div class="row pt-5 justify-content-center">
    <div><h3><?php echo $entry{'title'}; ?></h3>
    <p><a href="<?php echo $entry{'link'}; ?>"><?php echo $entry{'link'}; ?></a></p></div>
</div>
<div class="row pt-5 justify-content-center">
  <div class=""><p><?php echo $entry{'description'}; ?></p></div>
  <div class=""><p>author: <?php echo $entry{'post_date'}; ?></p></div>
</div>




<?php
  $statement = $pdo->prepare('select username, bio from user');
  $statement->execute();
  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Testing with username and bio text.
  foreach ($results as $result) {
      $username = $result['username'];
      $bio = $result['bio'];
      echo $username." ".$bio;
      ?>
      <!-- <div class="">
        <?php echo $username." ". $bio; ?>
      </div> -->

    <?php
    }
    ?>
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

<?php require __DIR__.'/views/header.php';

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

<?php
$statement = $pdo->prepare('select username, bio from user');
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $result) {
    $username = $result['username'];
    $bio = $result['bio'];

    ?>
    <div class="">
      <?php echo "$username and $bio"; ?>
    </div>

<?php
}

 require __DIR__.'/views/footer.php'; ?>

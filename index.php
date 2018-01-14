<?php require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$authenticated = $_SESSION['authenticated'] ?? false;
?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>A link-posting-community.</p>

    <?php if ($message !== ''): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>

<?php require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$authenticated = $_SESSION['authenticated'] ?? false;
?>

<?php if ($message !== ''): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>A link-posting-community.</p>

    <?php if (isset($_SESSION['userSession'])): ?>
        <p>Welcome, <?php echo $_SESSION['userSession']['email']?>!</p>
    <?php endif; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>

<?php require __DIR__.'/views/header.php';

//if a user is logged in
$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>

<article>
    <h1>Profile</h1>
    <p>This is the new profile page.</p>
</article>


<form action="upload.php" method="post" enctype="multipart/form-data">
      <label for="avatar">Choose an image to upload</label>
      <input type="file" name="avatar" accept=".png" required>

      <button type="submit">Upload</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>

<?php require __DIR__.'/views/header.php';

//if a user is logged in
$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>

<article>
    <h1>Profile</h1>
    <p>This is the new profile page.</p>
    <p>Default profile pic below this text</p>
</article>


<form action="upload.php" method="post" enctype="multipart/form-data">

  <div class="form-group">
            <!-- Displays defualt image if the user has not uploaded an image yet -->
            <?php if (!isset($_SESSION['userSession']['avatar'])): ?>
                <img src="uploads/profilestart.png" alt="default" class="img-thumbnail">
            <?php else : ?>
                <img src="uploads/<?php echo $_SESSION['userSession']['avatar'] ?>" class="img-thumbnail">
            <?php endif; ?>
  </div>


      <label for="avatar">Choose an image to upload</label>
      <input type="file" name="avatar" accept=".png" required>

      <button type="submit">Upload</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>

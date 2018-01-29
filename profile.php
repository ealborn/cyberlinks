<?php
require __DIR__.'/views/header.php';

//if a user is logged in
$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

if ($message !== ''): ?>
<p><?php echo $message; ?></p>
<?php endif;
?>

<article>
  <h1>Profile for <?php echo $userSession['username'] ?></h1>
  <p>This is your own profile page. Here you can edit your stuff.</p>
</article>


<form action="upload.php" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <!-- Displays defualt image if the user has not uploaded an image yet -->
    <?php if (!isset($userSession['avatar'])): ?>
      <img src="uploads/profilestart.png" alt="default" class="img-thumbnail">
    <?php else : ?>
      <img src="uploads/<?php echo $userSession['avatar']; ?>" class="img-thumbnail">
      <br>
      <h4>Biography:</h4>
      <?php echo $userSession['bio']; ?>
    <?php endif; ?>
  </div>


  <label for="avatar">Update user image (only .png accepted)</label>
  <input type="file" name="avatar" accept=".png" required>

  <button type="submit" class="btn btn-sm mt-1">Upload</button>
</form>

    <form action="/app/auth/updateprofile.php" method="POST">
        <label for="textarea">Update biography</label>
        <textarea class="form-control" name="bio" rows="3"><?php echo $userSession['bio']; ?></textarea>
        <button type="submit" class="btn btn-sm mt-1">Update bio</button>
    </form>

    <form action="/app/auth/updateprofile.php" method="POST">
        <label for="input">Update e-mail</label>
        <input class="form-control" name="email" placeholder="<?php echo $userSession['email']; ?>"></input>
        <button type="submit" class="btn btn-sm mt-1">Update e-mail</button>
    </form>

    <form action="/app/auth/updateprofile.php" method="POST">
        <label for="input">Update password</label>
        <input class="form-control" name="password" type="password"></input>
        <button type="submit" class="btn btn-sm mt-1">Update password</button>
    </form>


<?php require __DIR__.'/views/footer.php'; ?>

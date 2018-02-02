<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// check if a user is logged in
$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<div class="container">

  <div class="card">
    <div class="card-body">

      <h3>Profile for <?php echo $userSession['username'] ?></h3>
      <p>This is your own profile page. Here you can edit your stuff.</p>
      <div class="row">
        <div class="col">
          <!-- Displays defualt image if the user has not uploaded an image yet -->
          <?php if (!isset($userSession['avatar'])): ?>
            <img src="assets/defaults/profilestart.png" alt="default image" class="img-thumbnail">
          <?php else : ?>
            <!-- else display users uploaded avatar image -->
            <img src="uploads/<?php echo $userSession['avatar']; ?>" class="img-thumbnail">
          <?php endif; ?>
        </div>

        <div class="col">
          <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="avatar">Update user image (only .png accepted)</label>
            <input type="file" name="avatar" accept=".png" required>
            <button type="submit" class="btn btn-primary btn-sm">Upload new avatar</button>
          </form>
        </div>
      </div> <!-- /row -->
    </div> <!-- /card body-->
  </div> <!-- /card -->

  <div class="card">
    <h5 class="col-6">Your Biography:</h5>
    <p class="col-6"><?php echo $userSession['bio']; ?></p>
  </div>

  <!-- update user profile -->
  <?php
  // fetch from database again
  $statement = $pdo->prepare('SELECT * FROM User');
  $statement->execute();
  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  //loop through User array to get all the data
  foreach ($results as $result) {
    $bio = $result['bio'];
    $email = $result['email'];
    $password = $result['password'];
  } ?>

   <!-- update biography, email or password form -->
      <form action="/app/auth/updateprofile.php" method="POST">
          <label for="textarea">Update biography</label>
          <textarea class="form-control" name="bio" rows="3"><?php echo $bio; ?></textarea>
          <button type="submit" class="btn btn-primary btn-sm">Update bio</button>
      </form>

      <form action="/app/auth/updateprofile.php" method="POST">
          <label for="input">Update e-mail</label>
          <input class="form-control" name="email" placeholder="<?php echo $email; ?>"></input>
          <button type="submit" class="btn btn-primary btn-sm">Update e-mail</button>
      </form>

      <form action="/app/auth/updateprofile.php" method="POST">
          <label for="input">Update password</label>
          <input class="form-control" name="password" type="password"></input>
          <button type="submit" class="btn btn-primary btn-sm">Update password</button>
      </form>

</div> <!-- /container -->

<?php require __DIR__.'/views/footer.php'; ?>

<?php
require __DIR__.'/views/header.php';

// check if a user is logged in
$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

//removed message thingy here, if it won't work to log in could be why.
?>

<article>
  <h1>Profile for <?php echo $userSession['username'] ?></h1>
  <p>This is your own profile page. Here you can edit your stuff. Link to update part of page.</p>
  <p>Or update/delete your posts, link to that part here.</p>
</article>


<article>
<form action="upload.php" method="post" enctype="multipart/form-data">

    <!-- Displays defualt image if the user has not uploaded an image yet -->
    <?php if (!isset($userSession['avatar'])): ?>
      <img src="uploads/profilestart.png" alt="default" class="img-thumbnail">
    <?php else : ?>
      <!-- else display users uploaded avatar image -->
      <img src="uploads/<?php echo $userSession['avatar']; ?>" class="img-thumbnail">
    <?php endif; ?>

      <h4>Your Biography:</h4>
      <div class="row">

        <?php echo $userSession['bio']; ?>

      </div>


  <label for="avatar">Update user image (only .png accepted)</label>
  <input type="file" name="avatar" accept=".png" required>
  <button type="submit" class="btn btn-sm mt-1">Upload new avatar</button>
</article>

<p>här är jag!!!</p>




</form>
<!-- update user profile stuff-working!!!-->
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
  //echo "$bio";
  //echo "$email";
  //echo "$password";
} ?>

 <!-- working, do not touch!!! updates both to database and to page! -->
    <form action="/app/auth/updateprofile.php" method="POST">
        <label for="textarea">Update biography</label>
        <textarea class="form-control" name="bio" rows="3"><?php echo $bio; ?></textarea>
        <button type="submit" class="btn btn-sm mt-1">Update bio</button>
    </form>

    <form action="/app/auth/updateprofile.php" method="POST">
        <label for="input">Update e-mail</label>
        <input class="form-control" name="email" placeholder="<?php echo $email; ?>"></input>
        <button type="submit" class="btn btn-sm mt-1">Update e-mail</button>
    </form>

    <form action="/app/auth/updateprofile.php" method="POST">
        <label for="input">Update password</label>
        <input class="form-control" name="password" type="password"></input>
        <button type="submit" class="btn btn-sm mt-1">Update password</button>
    </form>

<?php require __DIR__.'/views/footer.php'; ?>

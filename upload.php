<?php
require __DIR__.'/app/autoload.php';

//insert session check
$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

// get session ID.
$id = $_SESSION['userSession']['user_id'];

// if avatar image is selected
if (isset($_FILES['avatar'])) {
  $avatar = $_FILES['avatar'];
  $path = pathinfo($_FILES['avatar']['name']);
  $ext = $path['extension'];
  $filename = $_SESSION['userSession']['username'].'.'.$ext;
  echo $filename;

  // moves file with users name and extension to the uploads folder.
  move_uploaded_file($avatar['tmp_name'], __DIR__.'/uploads/'.$filename);

  // update the avatar to the database
  $updateAvatar = $pdo->prepare("UPDATE User SET avatar = :avatar WHERE user_id = :user_id");

  //if the above doesn't work, stop script and show error.
  if (!$updateAvatar) {
    die(var_dump (
      $pdo->errorInfo()
    ));
  }
  // If it works, keep going to work through the PDO process
  $updateAvatar->bindParam(':user_id', $id, PDO::PARAM_INT);
  $updateAvatar->bindParam(':avatar', $filename, PDO::PARAM_STR);
  $updateAvatar->execute();

  if (!$updateAvatar) {
    die(var_dump($pdo->errorInfo()));
  }


  //get the new avatar data from the database and save it in a session.
  $newAvatar = $pdo->prepare("SELECT * FROM User where user_id = :user_id");

  if (!$newAvatar) {
    die(var_dump($pdo->errorInfo()));
  }

  $newAvatar->bindParam(':user_id', $_SESSION['userSession']['user_id'], PDO::PARAM_INT);
  $newAvatar->execute();
  $user = $newAvatar->fetch(PDO::FETCH_ASSOC);
  $_SESSION['userSession'] = $user;
  redirect('/profile.php');
}
// går att använda fetch om du inte använder något kolon i din SQL query. annars måste prepare/bindparam/excecute användas.

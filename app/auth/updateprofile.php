<?php
require __DIR__.'/../autoload.php';

// Update user biography
if (isset($_POST['bio'])) {
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $updateBio = $pdo->prepare("UPDATE User SET bio=:bio WHERE user_id=:id");
    $id = $_SESSION['userSession']['user_id'];
    $updateBio->bindParam(':id', $id, PDO::PARAM_INT);
    $updateBio->bindParam(':bio', $bio, PDO::PARAM_STR);
    $updateBio->execute();
      if (!$updateBio) {
          die(var_dump($pdo->errorInfo()));
      }
}

// Update user email
if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $updateEmail = $pdo->prepare("UPDATE User SET email=:email WHERE user_id=:id");
    $id = $_SESSION['userSession']['user_id'];
    $updateEmail->bindParam(':id', $id, PDO::PARAM_INT);
    $updateEmail->bindParam(':email', $email, PDO::PARAM_STR);
    $updateEmail->execute();
      if (!$updateEmail) {
        die(var_dump($pdo->errorInfo()));
      }
}

// Update user password
if (isset($_POST['password'])) {
    $password = filter_var($_POST['password']);
    $id = $_SESSION['userSession']['user_id'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $updatePassword = $pdo->prepare("UPDATE User SET password=:password WHERE user_id=:id");
    $updatePassword->bindParam(':id', $id, PDO::PARAM_INT);
    $updatePassword->bindParam(':password', $passwordHash, PDO::PARAM_STR);
    $updatePassword->execute();
      if (!$updatePassword) {
          die(var_dump($pdo->errorInfo()));
      }
}

redirect('/profile.php');

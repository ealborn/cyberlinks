<?php
require __DIR__.'/../autoload.php';

// Check if username and password are filled into login form
if (isset($_POST['username'], $_POST['password'])) {
  $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

  // Prepare, bind email parameter and execute the database query.
  $statement = $pdo->prepare('SELECT * FROM User WHERE username = :username');
  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->execute();

  // Fetch the user as an associative array.
  $user = $statement->fetch(PDO::FETCH_ASSOC);

  // If we couldn't find the user in the database, redirect back to login page
  if (!$user) {
    redirect('../../login.php');
  }

  // If we found the user in the database, compare typed in password with the one in the database using password_verify.
  $userSession = $_SESSION['userSession'] ?? false; //return left if set and not NULL, return right otherwise.
  if ($username === $user['username'] && password_verify($password, $user['password'])) {
    $_SESSION['message'] = sprintf('Welcome, %s!', $user['username']);
    $_SESSION['userSession'] = true;
  } else {
    $_SESSION['message'] = 'Whoops. Looks like you missed something. Please try again.';
  }

  // If the password matches, save the user in a session.
  // unsave the password in the session!
  unset($user['password']);

  $_SESSION['userSession'] = $user;
  // redirect the user
  redirect('../../profile.php');
}

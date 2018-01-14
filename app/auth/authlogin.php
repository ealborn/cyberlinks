<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Check if email and password exists in the POST request.

    //ny test från vin exemmpel
    if (isset($_POST['email'], $_POST['password'])) {
      $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)); //trim where?
      $password = ($_POST['password']);//htmlentities pre-POST?

      // Prepare, bind email parameter and execute the database query.
      $statement = $pdo->prepare('SELECT * FROM User WHERE email = :email');
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->execute();

      // Fetch the user as an associative array.
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      // If we couldn't find the user in the database, redirect back to login page
      if (!$user) {
          die(var_dump($pdo->errorInfo()));
          //redirect('../../login.php');
      }

        // If we found the user in the database, compare typed in password with the one in the database using password_verify.
        $authenticated = $_SESSION['authenticated'] ?? false;
        if ($email === $user['email'] && password_verify($password, $user['password'])) {
          $_SESSION['message'] = sprintf('You\'ve successfully logged in %s!', $user['name']);
          $_SESSION['authenticated'] = true;
      } else {
          $_SESSION['message'] = 'Whoops. Looks like you missed something. Please try again.';
      }

          // If the password matches, save the user in a session.
          // unsave the password in the session!
          unset($user['password']);

          $_SESSION['userSession'] = $user;
          // redirect the user
          redirect('../../index.php');
      }
  }

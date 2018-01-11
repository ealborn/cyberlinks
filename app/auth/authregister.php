<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = password_hash(filter_var($_POST['password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

    $registerUser = $pdo->prepare("INSERT INTO user(Username, Email, Password) VALUES (:username, :email, :password)");
        if (!$registerUser) {
            die(var_dump($pdo->errorInfo()));
        }
    $registerUser->bindParam(':username', $username, PDO::PARAM_STR);
    $registerUser->bindParam(':email', $email, PDO::PARAM_STR);
    $registerUser->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $registerUser->execute();
    
    redirect('../../login.php');
}

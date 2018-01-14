<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// // Remove the user session variable and redirect the user back to the homepage.
// unset($_SESSION['username']);
//
// redirect('/');

if (isset($_SESSION['authenticated'])) {
    unset($_SESSION['authenticated']);
    $_SESSION['message'] = 'You are successfully logged out!';
}
redirect('../../login.php');

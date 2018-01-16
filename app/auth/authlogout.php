<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Remove the user session variable and redirect the user back to the homepage.

if (isset($_SESSION['userSession'])) {
    unset($_SESSION['userSession']);
    $_SESSION['message'] = 'You are successfully logged out!';
}
redirect('../../login.php');

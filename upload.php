<?php
//require __DIR__.'/views/header.php';
require __DIR__.'/app/autoload.php';

$userSession = $_SESSION['userSession'] ?? false;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$id = $_SESSION['userSession']['user_id'];

// if avatar image is selected
if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $path = pathinfo($_FILES['avatar']['name']);
    $ext = $path['extension'];
    $filename = $_SESSION['userSession']['username'].'.'.$ext;
    echo $filename;


    //move_uploaded_file($avatar['tmp_name'], __DIR__.'/uploads//'.$filename); //funkar lokalt till mappen uploads
    move_uploaded_file($avatar['tmp_name'], __DIR__.'/uploads/'.$filename);

  // update the image to the database

    //die(var_dump($id));
    $updateAvatar = $pdo->prepare("UPDATE User SET avatar = :avatar WHERE user_id = :user_id");
    //$updateAvatar = $pdo->prepare("INSERT INTO User (avatar) values (:avatar)");
    echo "<br/>";
    var_dump($updateAvatar);
    echo "<br/>";
    //if the above doesn't work, stop script and show error.
    if (!$updateAvatar) {
      die(var_dump (
        $pdo->errorInfo()
      ));
    }
    // den andra parametern efter : är den som binder med den nedan.
    // de kan därför heta vadsomhelst.
    // den första parametern är den som är namnet i databasen.
    //om errormeddelande ... är det fel i SQL-satsen
    //var_dumpa variabeln med die(var_dump) tex die(var_dump($pdo->errorInfo()));
    //om var_dumpen ligger i en if-sats, flytta ner alla bindparams och excecute under if-satsen
    //så att den inte utför dem innan den kollar om nåt går fel.
    $updateAvatar->bindParam(':user_id', $id, PDO::PARAM_INT);
    $updateAvatar->bindParam(':avatar', $filename, PDO::PARAM_STR);
    $updateAvatar->execute();
    if (!$updateAvatar) {
      die(var_dump($pdo->errorInfo()));
    }

    //get the new data from the database and save it in a session.
    $newAvatar = $pdo->prepare("SELECT * FROM User where user_id = ':user_id'");


    if (!$newAvatar) {
      die(var_dump($pdo->errorInfo()));
    }
    $newAvatar->bindParam(':user_id', $_SESSION['userSession']['user_id'], PDO::PARAM_INT);
    $newAvatar->execute();

    $user = $newAvatar->fetch(PDO::FETCH_ASSOC);
    die(var_dump($user));
    $_SESSION['userSession'] = $user;
    //redirect('/profile.php');
}
// går att använda fetch om du inte använder något kolon i din SQL query. annars måste prepare/bindparam/excecute användas.

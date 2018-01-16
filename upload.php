<?php
require __DIR__.'/views/header.php';

// if avatar image is selected
if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $path = pathinfo($_FILES['avatar']['name']);
    $ext = $path['extension'];
    $filename = $_SESSION['userSession']['username'].'.'.$ext;
    move_uploaded_file($avatar['tmp_name'], __DIR__.'/uploads//'.$filename);

  // update the image to the database
    $id = $_SESSION['userSession']['user_id'];
    //die(var_dump($id));
    $updateUserPic = $pdo->prepare("UPDATE User SET avatar=:avatar WHERE user_id=:user_id");
    // den andra parametern efter : är den som binder med den nedan.
    // de kan därför heta vadsomhelst.
    // den första parametern är den som är namnet i databasen.
    //om errormeddelande ... är det fel i SQL-satsen
    //var_dumpa variabeln med die(var_dump) tex die(var_dump($pdo->errorInfo()));
    //om var_dumpen ligger i en if-sats, flytta ner alla bindparams och excecute under if-satsen
    //så att den inte utför dem innan den kollar om nåt går fel.
    $updateUserPic->bindParam(':user_id', $id, PDO::PARAM_INT);
    $updateUserPic->bindParam(':avatar', $fileName, PDO::PARAM_STR);
    $updateUserPic->execute();
    if (!$updateUserPic) {
      die(var_dump($pdo->errorInfo()));
    }
}
// går att använda fetch om du inte använder något kolon i din SQL query. annars måste prepare/bindparam/excecute användas.
?>

<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';


$var = filter_var($_POST['entry_id'], FILTER_SANITIZE_NUMBER_INT);

die(var_dump($var));

$stmt = $pdo->prepare("SELECT Entry.*, User.user_id, User.username, User.avatar, Votes.*
  FROM Entry JOIN User ON Entry.poster=User.username
  JOIN Votes ON Votes.vote_id=Entry.entry_id
  WHERE entry_id='$var'");

$stmt->bindParam(':entry_id', $var, PDO::PARAM_INT);


$stmt->execute();
$entry = $stmt->fetch(PDO::FETCH_ASSOC); //fetching the first row of results from the array.
if (!$stmt) {
    die(var_dump($pdo->errorInfo()));
}
// foreach ($entries as $entry) {
//   $title = $entry['title'];
//   $link = $entry['link'];
//   $description = $entry['description'];
//   $post_date = $entry['post_date'];
//   $score = $entry['score'];
 ?>
<div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="col-md-6">
                <form action="app/posts/autheditpost.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $entry['entry_id']; ?>">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" value="<?php echo $entry['title']; ?>">
                        <small class="form-text text-muted">Edit title.</small>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Description</label>
                        <input class="form-control" type="text" name="description" value="<?php echo $entry['description']; ?>">
                        <small class="form-text text-muted">Edit the description.</small>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Cyberlink</label>
                        <input class="form-control" type="url" name="link" value="<?php echo $entry['link']; ?>">
                        <small class="form-text text-muted">Edit the cyberlink</small>
                    </div><!-- /form-group -->

                    <button type="submit" class="btn btn-primary">Submit edit</button>
                </form>
            </div><!-- /col-md-6 -->
        </div><!-- /row -->
    </div><!-- /container -->

<?php
require __DIR__.'/views/footer.php';
?>

<?php require __DIR__.'/views/header.php';?>

    <div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="col-md-6">
                <form  action="app/posts/addpost.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $director['id']; ?>">

                    <div class="form-group">
                        <label for="title">First name</label>
                        <input class="form-control" type="text" name="first_name" value="<?php echo $director['first_name']; ?>">
                        <small class="form-text text-muted">Please provide the director's first name.</small>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Last name</label>
                        <input class="form-control" type="text" name="last_name" value="<?php echo $director['last_name']; ?>">
                        <small class="form-text text-muted">Please provide the director's last name.</small>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">TMDb URL</label>
                        <input class="form-control" type="url" name="tmdb_url" value="<?php echo $director['tmdb_url']; ?>">
                        <small class="form-text text-muted">Please provide the movie's TMDb URL.</small>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Biography</label>
                        <textarea class="form-control" name="biography" rows="8" cols="80"><?php echo $director['biography']; ?></textarea>
                        <small class="form-text text-muted">Please provide the director's biography.</small>
                    </div><!-- /form-group -->

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div><!-- /col-md-6 -->
        </div><!-- /row -->
    </div><!-- /container -->

<?php require __DIR__.'/views/footer.php'; ?>

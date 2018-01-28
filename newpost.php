<?php require __DIR__.'/views/header.php';?>

    <div class="container">
        <div class="row pt-5 justify-content-center">
            <div class="col-md-6">
                <form  action="app/posts/addpost.php" method="post">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" required>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Cyberlink</label>
                        <input class="form-control" type="text" name="Link" required>
                    </div>
                    <!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Description</label>
                        <input class="form-control" type="url" name="Description" required>
                    </div><!-- /form-group -->
                    
                    <button type="submit" class="btn btn-primary">Post link</button>
                </form>
            </div><!-- /col-md-6 -->
        </div><!-- /row -->
    </div><!-- /container -->

<?php require __DIR__.'/views/footer.php'; ?>

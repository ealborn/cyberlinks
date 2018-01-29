<div class="container">

        <div class="row pt-5 justify-content-center">
            <div class="col-md-6">
              <h2>Make a new post</h2>
                <form  action="app/posts/addpost.php" method="post">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" required>
                    </div><!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Cyberlink</label>
                        <input class="form-control" type="url" name="link" required>
                    </div>
                    <!-- /form-group -->

                    <div class="form-group">
                        <label for="title">Description</label>
                        <input class="form-control" type="text" name="description" required>
                    </div><!-- /form-group -->

                    <button type="submit" class="btn btn-primary">Submit cyberlink</button>
                </form>
            </div><!-- /col-md-6 -->
        </div><!-- /row -->
    </div><!-- /container -->

<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/auth/authlogin.php" method="post">
        <div class="form-group">
          <!-- <label for="email">Email</label>
          <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
          <small class="form-text text-muted">Please provide the your email address.</small>
      </div><!-- /form-group -->

          <label for="username">Username</label>
          <input class="form-control" type="text" name="username" placeholder="Francis" required>
          <small class="form-text text-muted">Please provide your username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please enter your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p>Do you need to register instead? <a href="/register.php">Register</a></p>
</article>

<?php require __DIR__.'/views/footer.php'; ?>

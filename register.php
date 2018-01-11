<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>

    <form action="/app/auth/authregister.php" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="your username" required>
            <small class="form-text text-muted">Enter your username</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="example@someaddress.com" required>
            <small class="form-text text-muted">Enter your email address</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="your passphrase" required>
            <small class="form-text text-muted">Enter a password</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-dark">Register</button>
    </form>
</article>

<hr class="mt-5 mb-5">
<article>
    <h3>Already a member?</h3>
    <h5>Log in <a href="/login.php">here</a>.</h5>
</article>

<?php require __DIR__.'/views/footer.php'; ?>

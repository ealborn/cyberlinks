<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
        </li><!-- /nav-item -->

        <?php if (isset($_SESSION['userSession'])) : ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/profile.php' ? 'active' : ''; ?>" href="/profile.php">Profile</a>
        </li><!-- /nav-item -->
        <?php endif; ?>

        <?php if (isset($_SESSION['userSession'])): ?>
        <li class="nav-item">
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/userposts.php' ? 'active' : ''; ?>" href="/userposts.php">Posts</a>
        </li><!-- /nav-item -->
        <?php endif; ?>

        <?php if (isset($_SESSION['userSession'])) : ?>
        <li class="nav-item">
                <a class="nav-link" href="/app/auth/authlogout.php">Logout</a>
          <?php else: ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
        <?php endif; ?>
        </li><!-- /nav-item -->
    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->

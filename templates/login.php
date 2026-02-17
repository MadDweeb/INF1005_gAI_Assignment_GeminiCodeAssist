
<div class="step-content">
    <h3>Login</h3>
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success') : ?>
        <div class="alert alert-success">
            Onboarding complete! Please log in.
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])) : ?>
        <div class="alert alert-danger">
            <?php
            if ($_GET['error'] === 'invalid') {
                echo 'Invalid username or password.';
            } else {
                echo 'An error occurred.';
            }
            ?>
        </div>
    <?php endif; ?>
    <form action="src/process_login.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="mt-3">
        <p>Don't have an account? <a href="index.php?step=username">Sign up here</a>.</p>
    </div>
</div>

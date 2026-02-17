
<div class="step-content">
    <h3>Dashboard</h3>
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="index.php?step=view_profiles" class="btn btn-primary">View User Profiles</a>
        <a href="index.php?step=edit_profile" class="btn btn-secondary">Edit Profile</a>
        <a href="src/logout.php" class="btn btn-danger">Logout</a>
    <?php else : ?>
        <p>You are not logged in.</p>
        <a href="index.php?step=login" class="btn btn-primary">Login</a>
    <?php endif; ?>
</div>

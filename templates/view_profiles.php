
<div class="step-content">
    <h3>User Profiles</h3>
    <div class="row">
        <?php
        include_once 'src/functions.php';
        $users = get_all_users();
        foreach ($users as $user) :
        ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($user['username']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($user['name']); ?></p>
                        <a href="index.php?step=view_profile&user_id=<?php echo $user['id']; ?>" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php?step=dashboard" class="btn btn-secondary">Back to Dashboard</a>
</div>

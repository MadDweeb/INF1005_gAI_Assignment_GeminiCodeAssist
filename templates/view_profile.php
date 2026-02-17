
<div class="step-content">
    <?php
    include_once 'src/functions.php';
    if (isset($_GET['user_id'])) {
        $user = get_user_by_id($_GET['user_id']);
        $pets = get_pets_by_user_id($_GET['user_id']);
    }

    if (isset($user) && $user) :
    ?>
        <h3>Profile of <?php echo htmlspecialchars($user['username']); ?></h3>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" class="img-fluid" alt="Profile Picture">
            </div>
            <div class="col-md-8">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
            </div>
        </div>

        <hr>

        <h4>Pets</h4>
        <?php if (!empty($pets)) : ?>
            <div class="row">
                <?php foreach ($pets as $pet) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($pet['pet_photo']); ?>" class="card-img-top" alt="Pet Photo">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($pet['pet_name']); ?></h5>
                                <p class="card-text">
                                    <strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?><br>
                                    <strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>This user has no pets.</p>
        <?php endif; ?>

        <hr>
        <a href="index.php?step=view_profiles" class="btn btn-secondary">Back to All Profiles</a>

    <?php else : ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>

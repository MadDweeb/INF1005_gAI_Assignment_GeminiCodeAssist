
<div class="step-content">
    <h3>Edit Profile</h3>
    <?php
    include_once 'src/functions.php';
    if (!isset($_SESSION['user_id'])) {
        echo '<p>You must be logged in to edit your profile.</p>';
        echo '<a href="index.php?step=login" class="btn btn-primary">Login</a>';
    } else {
        $user = get_user_by_id($_SESSION['user_id']);
        $pets = get_pets_by_user_id($_SESSION['user_id']);
    ?>
    <form action="src/update_profile.php" method="post" enctype="multipart/form-data">
        <h4>Personal Info</h4>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
        </div>

        <h4>Profile Photo</h4>
        <div class="mb-3">
            <label for="profile_photo" class="form-label">Upload a new profile picture</label>
            <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*">
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Current Profile Photo" width="150" class="mt-2">
        </div>

        <hr>

        <h4>Your Pets</h4>
        <?php if (!empty($pets)) : ?>
            <?php foreach ($pets as $pet) : ?>
                <div class="pet-form mb-3 border p-3">
                    <h5><?php echo htmlspecialchars($pet['pet_name']); ?></h5>
                    <input type="hidden" name="pet_id[]" value="<?php echo $pet['id']; ?>">
                     <div class="mb-3">
                        <label class="form-label">Pet Name</label>
                        <input type="text" class="form-control" name="pet_name[]" value="<?php echo htmlspecialchars($pet['pet_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Breed</label>
                        <input type="text" class="form-control" name="pet_breed[]" value="<?php echo htmlspecialchars($pet['breed']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="pet_age[]" value="<?php echo htmlspecialchars($pet['age']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pet Photo</label>
                        <input type="file" class="form-control" name="pet_photo[]" accept="image/*">
                        <img src="<?php echo htmlspecialchars($pet['pet_photo']); ?>" alt="Current Pet Photo" width="150" class="mt-2">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <hr>
        <a href="index.php?step=dashboard" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Save Changes</button>
    </form>

    <hr>
    <h4>Delete Profile</h4>
    <p>This action is irreversible.</p>
    <form action="src/delete_profile.php" method="post" onsubmit="return confirm('Are you sure you want to delete your profile?');">
        <button type="submit" class="btn btn-danger">Delete My Profile</button>
    </form>
    <?php } ?>
</div>

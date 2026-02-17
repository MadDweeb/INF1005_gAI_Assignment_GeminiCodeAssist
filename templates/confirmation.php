
<div class="step-content">
    <h3>Step 5: Confirmation and Save</h3>
    <?php
    if (isset($_SESSION['onboarding_data'])) {
        $data = $_SESSION['onboarding_data'];
    ?>
        <h4>Username</h4>
        <p><?php echo htmlspecialchars($data['username']); ?></p>

        <h4>Personal Info</h4>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($data['contact']); ?></p>

        <h4>Profile Photo</h4>
        <img src="<?php echo htmlspecialchars($data['profile_picture']); ?>" alt="Profile Photo" width="150">

        <h4>Pets</h4>
        <?php if (isset($data['pets']) && !empty($data['pets'])) : ?>
            <div class="row">
                <?php foreach ($data['pets'] as $pet) : ?>
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
            <p>No pets added.</p>
        <?php endif; ?>

        <hr>
        <form action="src/save_onboarding.php" method="post">
            <a href="index.php?step=pet_info" class="btn btn-secondary">Previous</a>
            <button type="submit" class="btn btn-success">Save</button>
        </form>

    <?php
    } else {
        echo "<p>No data to display.</p>";
    }
    ?>
</div>

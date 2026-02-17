
<div class="step-content">
    <h3>Step 3: Profile Photo</h3>
    <form action="src/process_profile_photo.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="profile_photo" class="form-label">Upload a profile picture</label>
            <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*" required>
        </div>
        <a href="index.php?step=personal_info" class="btn btn-secondary">Previous</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>


<div class="step-content">
    <h3>Step 2: Personal Info</h3>
    <form action="src/process_personal_info.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
        <a href="index.php?step=username" class="btn btn-secondary">Previous</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>

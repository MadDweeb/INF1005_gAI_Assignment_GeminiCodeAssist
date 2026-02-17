
<div class="step-content">
    <h3>Step 4: Pet Info</h3>
    <form action="src/process_pet_info.php" method="post" enctype="multipart/form-data">
        <div id="pet-forms-container">
            <div class="pet-form mb-3 border p-3">
                <h4>Pet 1</h4>
                <div class="mb-3">
                    <label for="pet_name_1" class="form-label">Pet Name</label>
                    <input type="text" class="form-control" id="pet_name_1" name="pet_name[]" required>
                </div>
                <div class="mb-3">
                    <label for="pet_breed_1" class="form-label">Breed</label>
                    <input type="text" class="form-control" id="pet_breed_1" name="pet_breed[]" required>
                </div>
                <div class="mb-3">
                    <label for="pet_age_1" class="form-label">Age</label>
                    <input type="number" class="form-control" id="pet_age_1" name="pet_age[]" required>
                </div>
                <div class="mb-3">
                    <label for="pet_photo_1" class="form-label">Pet Photo</label>
                    <input type="file" class="form-control" id="pet_photo_1" name="pet_photo[]" accept="image/*" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-info" id="add-pet-btn">Add Another Pet</button>
        <hr>
        <a href="index.php?step=profile_photo" class="btn btn-secondary">Previous</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let petCounter = 1;
    const addPetBtn = document.getElementById('add-pet-btn');
    const petFormsContainer = document.getElementById('pet-forms-container');

    addPetBtn.addEventListener('click', function() {
        petCounter++;
        const newPetForm = document.createElement('div');
        newPetForm.classList.add('pet-form', 'mb-3', 'border', 'p-3');
        newPetForm.innerHTML = `
            <h4>Pet ${petCounter}</h4>
            <div class="mb-3">
                <label for="pet_name_${petCounter}" class="form-label">Pet Name</label>
                <input type="text" class="form-control" id="pet_name_${petCounter}" name="pet_name[]" required>
            </div>
            <div class="mb-3">
                <label for="pet_breed_${petCounter}" class="form-label">Breed</label>
                <input type="text" class="form-control" id="pet_breed_${petCounter}" name="pet_breed[]" required>
            </div>
            <div class="mb-3">
                <label for="pet_age_${petCounter}" class="form-label">Age</label>
                <input type="number" class="form-control" id="pet_age_${petCounter}" name="pet_age[]" required>
            </div>
            <div class="mb-3">
                <label for="pet_photo_${petCounter}" class="form-label">Pet Photo</label>
                <input type="file" class="form-control" id="pet_photo_${petCounter}" name="pet_photo[]" accept="image/*" required>
            </div>
        `;
        petFormsContainer.appendChild(newPetForm);
    });
});
</script>

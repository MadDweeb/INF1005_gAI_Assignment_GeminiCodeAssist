<?php
session_start();
include '../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Update personal info
    $name = $_POST['name'] ?? '';
    $contact = $_POST['contact'] ?? '';

    // Update profile picture if a new one is uploaded
    $profile_picture_path = get_user_by_id($user_id)['profile_picture'];
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../images/profile_pictures/';
        $file_extension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $destination = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $destination)) {
            $profile_picture_path = 'images/profile_pictures/' . $filename;
        }
    }

    // Update user data in users.csv
    $users_file = '../data/users.csv';
    $users_data = file($users_file);
    $new_users_data = [];
    foreach ($users_data as $line) {
        $row = str_getcsv($line);
        if ($row[0] === $user_id) {
            $row[3] = $name;
            $row[4] = $contact;
            $row[5] = $profile_picture_path;
        }
        $new_users_data[] = $row;
    }
    $file_handle = fopen($users_file, 'w');
    foreach ($new_users_data as $row) {
        fputcsv($file_handle, $row);
    }
    fclose($file_handle);

    // Update pet info
    $pet_ids = $_POST['pet_id'] ?? [];
    $pet_names = $_POST['pet_name'] ?? [];
    $pet_breeds = $_POST['pet_breed'] ?? [];
    $pet_ages = $_POST['pet_age'] ?? [];
    $pet_photos = $_FILES['pet_photo'] ?? [];

    $pets_file = '../data/pets.csv';
    $pets_data = file($pets_file);
    $new_pets_data = [];
    // Keep the header
    $new_pets_data[] = str_getcsv(array_shift($pets_data));


    foreach ($pets_data as $line) {
        $row = str_getcsv($line);
        if ($row[1] === $user_id) {
            // Find the corresponding pet in the submitted form
            $pet_index = array_search($row[0], $pet_ids);
            if ($pet_index !== false) {
                $row[2] = $pet_names[$pet_index];
                $row[3] = $pet_breeds[$pet_index];
                $row[4] = $pet_ages[$pet_index];

                // Update pet photo if a new one is uploaded
                if (isset($pet_photos['name'][$pet_index]) && $pet_photos['error'][$pet_index] === UPLOAD_ERR_OK) {
                    $upload_dir = '../images/pet_pictures/';
                    $file_extension = pathinfo($pet_photos['name'][$pet_index], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $file_extension;
                    $destination = $upload_dir . $filename;
                    if (move_uploaded_file($pet_photos['tmp_name'][$pet_index], $destination)) {
                        $row[5] = 'images/pet_pictures/' . $filename;
                    }
                }
            }
        }
        $new_pets_data[] = $row;
    }

    $file_handle = fopen($pets_file, 'w');
    foreach ($new_pets_data as $row) {
        fputcsv($file_handle, $row);
    }
    fclose($file_handle);


    header('Location: ../index.php?step=dashboard&status=updated');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
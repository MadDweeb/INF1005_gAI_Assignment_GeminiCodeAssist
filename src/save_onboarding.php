<?php
session_start();
include '../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['onboarding_data'])) {
    $data = $_SESSION['onboarding_data'];

    // Update user data in users.csv
    $users_file = '../data/users.csv';
    $users_data = file($users_file);
    $new_users_data = [];

    foreach ($users_data as $line) {
        $row = str_getcsv($line);
        if ($row[0] === $data['id']) {
            $row[3] = $data['name'];
            $row[4] = $data['contact'];
            $row[5] = $data['profile_picture'];
        }
        $new_users_data[] = $row;
    }

    $file_handle = fopen($users_file, 'w');
    foreach ($new_users_data as $row) {
        fputcsv($file_handle, $row);
    }
    fclose($file_handle);


    // Save pet data
    if (isset($data['pets']) && !empty($data['pets'])) {
        $pets_file = fopen('../data/pets.csv', 'a');
        if ($pets_file) {
            foreach ($data['pets'] as $pet) {
                fputcsv($pets_file, [
                    uniqid(),
                    $data['id'],
                    $pet['pet_name'],
                    $pet['breed'],
                    $pet['age'],
                    $pet['pet_photo'],
                ]);
            }
            fclose($pets_file);
        }
    }

    // Clear session and redirect to login
    session_destroy();
    header('Location: ../index.php?step=login&status=success');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
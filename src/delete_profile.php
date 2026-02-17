<?php
session_start();
include '../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Remove user from users.csv
    $users_file = '../data/users.csv';
    $users_data = file($users_file);
    $new_users_data = [];
    foreach ($users_data as $line) {
        $row = str_getcsv($line);
        if ($row[0] !== $user_id) {
            $new_users_data[] = $row;
        } else {
            // Delete profile picture
            if (!empty($row[5]) && file_exists('../' . $row[5])) {
                unlink('../' . $row[5]);
            }
        }
    }
    $file_handle = fopen($users_file, 'w');
    foreach ($new_users_data as $row) {
        fputcsv($file_handle, $row);
    }
    fclose($file_handle);

    // Remove pets from pets.csv
    $pets_file = '../data/pets.csv';
    $pets_data = file($pets_file);
    $new_pets_data = [];
    foreach ($pets_data as $line) {
        $row = str_getcsv($line);
        if ($row[1] !== $user_id) {
            $new_pets_data[] = $row;
        } else {
            // Delete pet photo
            if (!empty($row[5]) && file_exists('../' . $row[5])) {
                unlink('../' . $row[5]);
            }
        }
    }
    $file_handle = fopen($pets_file, 'w');
    foreach ($new_pets_data as $row) {
        fputcsv($file_handle, $row);
    }
    fclose($file_handle);


    // Destroy session and redirect
    session_destroy();
    header('Location: ../index.php?step=username&status=deleted');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
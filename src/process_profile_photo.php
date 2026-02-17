<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../images/profile_pictures/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_extension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $destination = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $destination)) {
            $_SESSION['onboarding_data']['profile_picture'] = 'images/profile_pictures/' . $filename;
            header('Location: ../index.php?step=pet_info');
            exit();
        } else {
            header('Location: ../index.php?step=profile_photo&error=upload');
            exit();
        }
    } else {
        header('Location: ../index.php?step=profile_photo&error=file');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
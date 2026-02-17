<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $contact = $_POST['contact'] ?? '';

    // Basic validation
    if (empty($name) || empty($contact)) {
        header('Location: ../index.php?step=personal_info&error=empty');
        exit();
    }

    // Store data in session
    $_SESSION['onboarding_data']['name'] = $name;
    $_SESSION['onboarding_data']['contact'] = $contact;

    header('Location: ../index.php?step=profile_photo');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
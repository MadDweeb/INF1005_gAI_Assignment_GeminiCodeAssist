<?php
session_start();
include '../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Basic validation
    if (empty($username) || empty($password)) {
        header('Location: ../index.php?step=username&error=empty');
        exit();
    }

    // Check if username exists
    if (get_user_by_username($username)) {
        header('Location: ../index.php?step=username&error=exists');
        exit();
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Create a unique ID
    $user_id = uniqid();

    // Save user data
    $user_data = [
        $user_id,
        $username,
        $password_hash,
    ];

    if (save_user($user_data)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['onboarding_data'] = [
            'id' => $user_id,
            'username' => $username,
            'password' => $password_hash,
        ];
        header('Location: ../index.php?step=personal_info');
        exit();
    } else {
        header('Location: ../index.php?step=username&error=save');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
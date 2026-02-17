<?php
session_start();
include '../src/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header('Location: ../index.php?step=login&error=empty');
        exit();
    }

    $user = get_user_by_username($username);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: ../index.php?step=dashboard');
        exit();
    } else {
        header('Location: ../index.php?step=login&error=invalid');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
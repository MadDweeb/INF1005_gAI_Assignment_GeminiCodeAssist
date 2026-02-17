<?php
session_start();

// Define the steps
$steps = [
    'username',
    'personal_info',
    'profile_photo',
    'pet_info',
    'confirmation',
];

// Get the current step
$current_step = $_GET['step'] ?? 'username';

// If the user is not logged in and not on the username step, redirect to the beginning
if (!isset($_SESSION['user_id']) && $current_step !== 'username' && $current_step !== 'login') {
    header('Location: index.php?step=username');
    exit();
}

// Include the header
include 'templates/header.php';

// Include the content for the current step
$step_file = 'templates/' . $current_step . '.php';
if (file_exists($step_file)) {
    include $step_file;
} else {
    echo '<p>Invalid step.</p>';
}

// Include the footer
include 'templates/footer.php';
?>
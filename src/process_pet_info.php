<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pet_names = $_POST['pet_name'] ?? [];
    $pet_breeds = $_POST['pet_breed'] ?? [];
    $pet_ages = $_POST['pet_age'] ?? [];
    $pet_photos = $_FILES['pet_photo'] ?? [];

    $pets_data = [];

    $upload_dir = '../images/pet_pictures/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    for ($i = 0; $i < count($pet_names); $i++) {
        $pet_name = $pet_names[$i];
        $pet_breed = $pet_breeds[$i];
        $pet_age = $pet_ages[$i];

        if (empty($pet_name) || empty($pet_breed) || empty($pet_age)) {
            header('Location: ../index.php?step=pet_info&error=empty');
            exit();
        }

        $pet_photo_path = '';
        if (isset($pet_photos['name'][$i]) && $pet_photos['error'][$i] === UPLOAD_ERR_OK) {
            $file_extension = pathinfo($pet_photos['name'][$i], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $file_extension;
            $destination = $upload_dir . $filename;

            if (move_uploaded_file($pet_photos['tmp_name'][$i], $destination)) {
                $pet_photo_path = 'images/pet_pictures/' . $filename;
            }
        }

        $pets_data[] = [
            'pet_name' => $pet_name,
            'breed' => $pet_breed,
            'age' => $pet_age,
            'pet_photo' => $pet_photo_path,
        ];
    }

    $_SESSION['onboarding_data']['pets'] = $pets_data;

    header('Location: ../index.php?step=confirmation');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
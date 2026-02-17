<?php
// Helper functions for the application

function get_user_by_username(string $username): ?array
{
    $file = fopen('data/users.csv', 'r');
    if (!$file) {
        return null;
    }

    while (($row = fgetcsv($file)) !== false) {
        if ($row[1] === $username) {
            fclose($file);
            return [
                'id' => $row[0],
                'username' => $row[1],
                'password' => $row[2],
                'name' => $row[3] ?? '',
                'contact' => $row[4] ?? '',
                'profile_picture' => $row[5] ?? '',
            ];
        }
    }

    fclose($file);
    return null;
}


function get_all_users(): array
{
    $users = [];
    $file = fopen('data/users.csv', 'r');
    if (!$file) {
        return $users;
    }

    // Skip the header row
    fgetcsv($file);

    while (($row = fgetcsv($file)) !== false) {
        $users[] = [
            'id' => $row[0],
            'username' => $row[1],
            'name' => $row[3] ?? '',
            'profile_picture' => $row[5] ?? '',
        ];
    }

    fclose($file);
    return $users;
}


function get_user_by_id(string $user_id): ?array
{
    $file = fopen('data/users.csv', 'r');
    if (!$file) {
        return null;
    }

    while (($row = fgetcsv($file)) !== false) {
        if ($row[0] === $user_id) {
            fclose($file);
            return [
                'id' => $row[0],
                'username' => $row[1],
                'name' => $row[3] ?? '',
                'contact' => $row[4] ?? '',
                'profile_picture' => $row[5] ?? '',
            ];
        }
    }

    fclose($file);
    return null;
}

function get_pets_by_user_id(string $user_id): array
{
    $pets = [];
    $file = fopen('data/pets.csv', 'r');
    if (!$file) {
        return $pets;
    }

    // Skip the header row
    fgetcsv($file);

    while (($row = fgetcsv($file)) !== false) {
        if ($row[1] === $user_id) {
            $pets[] = [
                'id' => $row[0],
                'pet_name' => $row[2],
                'breed' => $row[3],
                'age' => $row[4],
                'pet_photo' => $row[5],
            ];
        }
    }

    fclose($file);
    return $pets;
}

function save_user(array $user_data): bool
{
    $file = fopen('data/users.csv', 'a');
    if (!$file) {
        return false;
    }

    $result = fputcsv($file, $user_data);

    fclose($file);

    return $result !== false;
}
?>

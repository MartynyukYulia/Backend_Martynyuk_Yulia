<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim(htmlspecialchars($_POST['login'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repeat_password = isset($_POST['repeat_password']) ? $_POST['repeat_password'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $games = isset($_POST['games']) ? $_POST['games'] : [];
    $about = isset($_POST['about']) ? trim(htmlspecialchars($_POST['about'])) : '';

    $errors = [];

    if (empty($login)) {
        $errors[] = 'Логін є обов\'язковим';
    } elseif (strlen($login) < 3) {
        $errors[] = 'Логін повинен містити не менше 3 символів';
    }

    if (empty($password)) {
        $errors[] = 'Пароль є обов\'язковим';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Пароль повинен містити не менше 6 символів';
    }

    if ($password !== $repeat_password) {
        $errors[] = 'Паролі не співпадають';
    }

    if (empty($gender) || ($gender !== 'male' && $gender !== 'female')) {
        $errors[] = 'Будь ласка, виберіть стать';
    }

    $valid_cities = ['Zhytomyr', 'Kyiv', 'Odesa', 'Vinnytsia', 'Ternopil'];
    if (empty($city) || !in_array($city, $valid_cities)) {
        $errors[] = 'Будь ласка, виберіть місто зі списку';
    }

    // Обробка завантаження фото
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "uploads/";

        // Створюємо папку, якщо вона не існує
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $photo_name = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Перевіряємо тип файлу (опціонально)
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($file_type, $allowed_types)) {
            // Переміщуємо завантажений файл
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $_SESSION['photo'] = $target_file;
                $_SESSION['photo_name'] = $photo_name;
            } else {
                $errors[] = 'Виникла помилка при завантаженні файлу';
            }
        } else {
            $errors[] = 'Дозволені лише файли JPG, JPEG, PNG і GIF';
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: index.php");
        exit;
    }

    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['gender'] = $gender;
    $_SESSION['city'] = $city;
    $_SESSION['games'] = $games;
    $_SESSION['about'] = $about;

    header("Location: result.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
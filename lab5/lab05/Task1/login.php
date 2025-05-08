<?php
session_start();
require_once 'db_config.php';

if (!isset($pdo)) {
    die("Неможливо підключитися до бази даних. Перевірте файл db_config.php.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        $error = "Будь ласка, введіть логін та пароль.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $stmt_update_login = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
                $stmt_update_login->bindParam(':id', $user['id']);
                $stmt_update_login->execute();
                header("Location: index.php");
                exit();
            } else {
                $stmt_check_login = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = :login");
                $stmt_check_login->bindParam(':login', $login);
                $stmt_check_login->execute();
                $login_count = $stmt_check_login->fetchColumn();

                if ($login_count == 0) {
                    $error = "Користувача з таким логіном не існує.";
                } else {
                    $error = "Невірний логін або пароль.";
                }
            }
        } catch (PDOException $e) {
            $error = "Помилка при виконанні запиту: " . $e->getMessage();
        }
    }
}

header("Location: index.php?error=" . urlencode(@$error));

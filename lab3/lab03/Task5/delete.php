<?php
// delete.php
session_start();
$message = '';
$messageType = '';

// Обробка форми
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = trim(htmlspecialchars($_POST['login']));
        $password = $_POST['password'];

        // Перевірка, чи не порожні поля
        if (!empty($login) && !empty($password)) {
            // Перевірка, чи існує такий логін
            if (!file_exists($login)) {
                $message = "Користувача з логіном '$login' не існує!";
                $messageType = 'error';
            } else {
                // Перевірка пароля
                $userData = json_decode(file_get_contents($login . '/user_info.json'), true);

                if (password_verify($password, $userData['password'])) {
                    // Рекурсивне видалення каталогу з усім вмістом
                    function deleteDirectory($dir) {
                        if (!file_exists($dir)) {
                            return true;
                        }

                        if (!is_dir($dir)) {
                            return unlink($dir);
                        }

                        foreach (scandir($dir) as $item) {
                            if ($item == '.' || $item == '..') {
                                continue;
                            }

                            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                                return false;
                            }
                        }

                        return rmdir($dir);
                    }

                    if (deleteDirectory($login)) {
                        $message = "Користувача '$login' та всі його дані успішно видалено!";
                        $messageType = 'success';
                    } else {
                        $message = "Виникла помилка при видаленні користувача '$login'!";
                        $messageType = 'error';
                    }
                } else {
                    $message = "Невірний пароль для користувача '$login'!";
                    $messageType = 'error';
                }
            }
        } else {
            $message = "Будь ласка, заповніть усі поля!";
            $messageType = 'error';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Видалення користувача</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin-top: 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Видалення користувача</h1>

<?php if (!empty($message)): ?>
    <div class="message <?php echo $messageType; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <div class="form-group">
        <label for="login">Логін:</label>
        <input type="text" id="login" name="login" required>
    </div>

    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <input type="submit" value="Видалити користувача">
</form>

<a href="index.php" class="btn">Назад до створення користувача</a>
</body>
</html>
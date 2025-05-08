<?php
session_start();
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = trim(htmlspecialchars($_POST['login']));
        $password = $_POST['password'];

        if (!empty($login) && !empty($password)) {
            if (file_exists($login)) {
                $message = "Користувач з логіном '$login' вже існує!";
                $messageType = 'error';
            } else {
                mkdir($login, 0755);

                mkdir($login . '/video', 0755);
                mkdir($login . '/music', 0755);
                mkdir($login . '/photo', 0755);

                file_put_contents($login . '/video/sample.mp4', 'This is a sample video file');
                file_put_contents($login . '/music/song.mp3', 'This is a sample music file');
                file_put_contents($login . '/photo/image.jpg', 'This is a sample photo file');

                $userData = [
                    'login' => $login,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];

                file_put_contents($login . '/user_info.json', json_encode($userData));

                $message = "Користувача '$login' успішно створено з усіма необхідними папками та файлами!";
                $messageType = 'success';
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
    <title>Створення користувача</title>
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
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            margin-top: 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<h1>Створення користувача</h1>

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

    <input type="submit" value="Створити користувача">
</form>

<a href="delete.php" class="btn">Видалити користувача</a>
</body>
</html>
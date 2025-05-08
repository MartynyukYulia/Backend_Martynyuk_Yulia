<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<?php
if (isset($_SESSION['user_id'])) {
    echo "<h1>Вітаємо, користувачу!</h1>";
    echo "<p><a href='profile.php'>Редагувати профіль</a></p>";
    echo "<p><a href='logout.php'>Вийти</a></p>";
} else {
    if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
        echo "<p style='color:green;'>Ваш профіль було успішно видалено.</p>";
    }
    ?>
    <h1>Вхід на сайт</h1>
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>".$_GET['error']."</p>";
    }
    ?>
    <form action="login.php" method="post">
        <div>
            <label for="login">Логін:</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Увійти</button>
    </form>
    <p><a href="register.php">Зареєструватися</a></p>
    <?php
}
?>
</body>
</html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "Добрий день, " . $_SESSION['username'] . "!";
    echo "<br><a href='?logout=true'>Вийти</a>";
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === 'Admin' && $password === 'password') {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            echo "Невірний логін або пароль!";
        }
    }

    ?>
    <h2>Форма авторизації</h2>
    <form method="POST">
        <label for="username">Логін:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Увійти">
    </form>
    <?php
}

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>

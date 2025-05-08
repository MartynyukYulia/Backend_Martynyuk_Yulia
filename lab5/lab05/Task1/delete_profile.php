<?php
session_start();
require_once 'db_config.php';

if (!isset($pdo)) {
    die("Неможливо підключитися до бази даних. Перевірте файл db_config.php.");
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_delete'])) {
        try {
            $stmt_delete = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt_delete->bindParam(':id', $user_id);

            if ($stmt_delete->execute()) {
                session_destroy();
                header("Location: index.php?deleted=1");
                exit();
            } else {
                $error = "Помилка при видаленні профілю.";
            }
        } catch (PDOException $e) {
            $error = "Помилка при виконанні запиту: " . $e->getMessage();
        }
    } else {
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення профілю</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<h1>Видалення профілю</h1>
<p>Ви впевнені, що хочете видалити свій профіль? Ця дія незворотня.</p>
<form action="" method="post">
    <input type="submit" name="confirm_delete" value="Видалити">
    <input type="submit" name="cancel_delete" value="Скасувати">
</form>
</body>
</html>

<?php
$font_size = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір розміру шрифту</title>
</head>
<body style="font-size: <?= $font_size; ?>;">

<h1>Виберіть розмір шрифту</h1>

<a href="process.php?size=big">Великий шрифт</a> |
<a href="process.php?size=medium">Середній шрифт</a> |
<a href="process.php?size=small">Маленький шрифт</a>
<br>
<a href="../pages/main.php">Назад</a>
</body>
</html>

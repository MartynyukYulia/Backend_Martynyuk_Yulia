<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список товарів</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=slim_db;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='success'>Підключення до бази даних slim_db успішне!</p>";
} catch(PDOException $e) {
    echo "<p class='error'>Помилка підключення до бази даних: " . $e->getMessage() . "</p>";
}

?>

<h2>Список товарів</h2>
<?php

if (isset($pdo)) {
    $sql = "SELECT * FROM tov";
    $result = $pdo->query($sql);

    if ($result) {
        echo "<table>";
        echo "<tr><th>Номер</th><th>Назва</th><th>Ціна</th><th>Кількість</th><th>Примітка</th></tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['cost'] . "</td>";
            echo "<td>" . $row['kol'] . "</td>";
            echo "<td>" . $row['note'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='error'>Помилка при отриманні даних з таблиці tov.</p>";
    }
}

?>

<h2>Керування записами</h2>
<form action="insert.php" method="get">
    <button type="submit">Додати запис</button>
</form>
<form action="delete.php" method="post">
    <label for="delete_id">Введіть ID запису для видалення:</label>
    <input type="text" id="delete_id" name="id">
    <button type="submit">Вилучити запис</button>
</form>

</body>
</html>
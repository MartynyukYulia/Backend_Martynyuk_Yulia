<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список працівників</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<h1>Список працівників</h1>
<div class="add-button">
    <a href="add_employee.php">Додати нового працівника</a>
</div>
<div class="stats-button">
    <a href="statistics.php">Переглянути статистику</a>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT id, name, position, salary FROM employees");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Ім'я</th><th>Посада</th><th>Зарплата</th><th>Дії</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["position"]."</td>";
            echo "<td>".$row["salary"]."</td>";
            echo "<td class='actions'>";
            echo "<a href='edit_employee.php?id=".$row["id"]."'>Редагувати</a>";
            echo "<a href='delete_employee.php?id=".$row["id"]."'>Видалити</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Не знайдено жодного працівника.</p>";
    }

} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
} finally {
    $conn = null;
}
?>
</body>
</html>
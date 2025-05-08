<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика працівників</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<h1>Статистика працівників</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Середня заробітна плата
    $stmt = $conn->query("SELECT AVG(salary) AS average_salary FROM employees");
    $averageSalaryResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $averageSalary = number_format($averageSalaryResult['average_salary'], 2);
    echo "<h2>Середня заробітна плата всіх працівників:</h2>";
    echo "<p>".$averageSalary."</p>";

    $stmt = $conn->query("SELECT position, COUNT(*) AS count FROM employees GROUP BY position");
    $positionsResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h2>Кількість працівників на кожній посаді:</h2>";
    echo "<ul>";
    foreach ($positionsResult as $row) {
        echo "<li>".$row['position'].": ".$row['count']."</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
} finally {
    $conn = null;
}
?>
<a href="index.php" class="back-link">Назад до списку працівників</a>
</body>
</html>